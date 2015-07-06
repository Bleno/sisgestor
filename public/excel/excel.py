#!/Python27/python
# -*- encoding: utf-8 -*-
print "Content-type: text/html"
print ""

import cgi
import cgitb; cgitb.enable()
import os, sys
from xlwt import *
from xlwt import Workbook,easyxf
from datetime import datetime
import calendar, sys
import MySQLdb
d = datetime.today()
d = str(d)[0:19].replace(':','-')+'.xls'
nome_arquivo = 'C:\wamp\www\sisgestor\public\excel\\'+ d.replace(' ','') #str(datetime.today())[0:19]+'.xls'



mes = { 1: 'Janeiro',
		2: 'Fevereiro',
		3: u'Março',
		4: 'Abril',
		5: 'Maio',
		6: 'Junho',
		7: 'Julho',
		8: 'Agosto',
		9: 'Setembro',
		10: 'Outubro',
		11: 'Novembro',
		12: 'Dezembro'
	}

semana = {  0: 'Segunda-Feira',
			1: u'Terça-Feira',
			2:'Quarta-Feira',
			3:'Quinta-Feira',
			4:'Sexta-Feira',
			5: u'Sábado',
			6:'Domingo'
		}

book = Workbook(encoding='iso-8859-15')
def criaPainel(ano, num_mes):
	tupla = ('Nome', u'Área',u'Nº','Curso','Unidade')
	indice = 0
	borders = Borders()
	borders.left = 6
	borders.right = 6
	borders.top = 6
	borders.bottom = 6

	#inicializa a variavel com o mes passado como parametro
	mes_sql = str(num_mes)
	if int(num_mes) < 10:
		mes_sql = "0" + str(num_mes)

	dia_fim_sql = str(calendar.monthrange(ano,num_mes)[1])
	sql = """
			SELECT nome, curso,`periodoInicio`,`periodoFim`,`horarioInicio`,`horarioFim`,
			`domingo`,`segunda`,`terca`,`quarta`,`quinta`,`sexta`,`sabado`
			FROM `ta_mapeamento`
			left join tb_docente on(id_docente = tb_docente.id)
			right join tb_curso on(id_curso = tb_curso.id)
			inner join tb_unidade on(id_unidade = tb_unidade.id)
			WHERE '%s-%s-01' between `periodoInicio` and `periodoFim` or '%s-%s-%s' between `periodoInicio` and `periodoFim`
			or `periodoInicio` between '%s-%s-01' and '%s-%s-%s' ORDER BY nome
			""" % (ano, mes_sql, ano, mes_sql, dia_fim_sql,ano, mes_sql, ano, mes_sql, dia_fim_sql)

	#print sql #print pra debug
	#estilo do painel superior fixo
	style = easyxf('pattern: pattern solid,  fore_colour ice_blue;' 'align: vertical center, horizontal center;' 'font: bold true')
	style.borders = borders

	#estilo usano em nomes
	style_name = easyxf('align: vertical center, horizontal center;')
	#style_name.borders = borders

	

	# Cria uma conexão
	con = MySQLdb.connect(db='sisgestor', user='root', passwd='')
	# Cria um cursor
	cur = con.cursor()

	#cria a planilha com nome do mes passado como parametro
	planilha = book.add_sheet(mes[num_mes], cell_overwrite_ok=True)
	#cria o painel superior
	for item in tupla:
		planilha.write_merge(0,1,indice,indice, item, style)
		if(indice != 2):
			planilha.col(indice).width = 8000
		indice += 1

	sqlContaDocente = """
							SELECT nome, eixo, unidade, ta_mapeamento.id, `periodoInicio`,`periodoFim`,`horarioInicio`,`horarioFim`,
					`domingo`,`segunda`,`terca`,`quarta`,`quinta`,`sexta`,`sabado`
					FROM `ta_mapeamento`
					left join tb_docente on(id_docente = tb_docente.id)
		            left join tb_eixo on(id_eixo = tb_eixo.id)
					right join tb_curso on(id_curso = tb_curso.id)
					inner join tb_unidade on(id_unidade = tb_unidade.id)
					WHERE '%s-%s-01' between `periodoInicio` and `periodoFim` or '%s-%s-%s' between `periodoInicio` and `periodoFim`
					or `periodoInicio` between '%s-%s-01' and '%s-%s-%s' ORDER BY nome
			""" % (ano, mes_sql, ano, mes_sql, dia_fim_sql,ano, mes_sql, ano, mes_sql, dia_fim_sql)

	cur.execute(sqlContaDocente)
	resultTupla = cur.fetchall()

	comeco = 2
	finalizar = 0
	lin = 2
	for q in resultTupla:
		
		# if int(q[0]) > 1:
		# 	finalizar = comeco + int(str(q[0]).replace('L','') ) -1
		# 	planilha.write_merge(comeco,finalizar,0,0, q[1], style_name)
		# 	planilha.write_merge(comeco,finalizar,1,1, q[2], style_name)
		# 	comeco = finalizar + 1
		# elif int(q[0]) == 1:
		#planilha.write(lin, 0, q[1], style_name)
		planilha.write(lin, 1, q[1], style_name)
		planilha.write(lin, 4, q[2], style_name)
		planilha.write(lin, 2, q[3], style_name)
			# comeco +=1
		lin +=1

	planilha.panes_frozen = True
	planilha.vert_split_pos = 2
	
	#intanciando um objeto calendario
	c = calendar.Calendar()
	#metodo retorna um iterador dia do mes e dia da semana
	i = c.itermonthdays2(int(ano), int(num_mes))
	col1 = 5
	col2 = 6
	dic = {}
	for d in i:
		if(d[0] != 0):
			planilha.write_merge(0,0,col1,col2,d[0],style)
			planilha.write_merge(1,1,col1,col2,semana[d[1]],style)
			col1 +=2
			col2 +=2
			dic[d[0]] = (col1, col2)
		else:
			pass

	#print dic #print pra debug
	#execulta o comando sql armazenado na variavel
	cur.execute(sql)
	#pega o resultado e coloca em tupulas
	result = cur.fetchall()
	#declaro duas variaveis, dia inicio e dia fim 
	d_ini = 0
	d_fim = 0
	# declaro um dicionario no qual vai ser armazenado os dias da semana que o docente foi escalado
	dia_semana = {}
	# variavel que armazena a posicao que dve iniciar a gravacao da linha do arquivo
	row_now = 2
	# for que percorre todos os resultados da consulta sql feita
	for linha in result:
		#print linha #opcao para debug
		#armazena o dia inicial como inteiro
		d_ini = int(str(linha[2])[8:10])
		# armazena o dia fim como inteiro
		d_fim = int(str(linha[3])[8:10])

		#verifica se o dia consultado no banco sai fora do alcance do mes recebido como paramentro, caso saia recebe o utltimo dia do mes recebido como parametro
		if d_fim > calendar.monthrange(ano,num_mes)[1]:
			d_fim = calendar.monthrange(ano,num_mes)[1]

		#preenche a lista com valores 0 e 1 para confirmar o dia trabalhado pelo docente, iniciando da posicao 7 que eh segunda-feira
		dia_semana[0] = int(linha[7])
		dia_semana[1] = int(linha[8])
		dia_semana[2] = int(linha[9])
		dia_semana[3] = int(linha[10])
		dia_semana[4] = int(linha[11])
		dia_semana[5] = int(linha[12])
		dia_semana[6] = int(linha[6])
		#armazeno somente o mes fim como inteiro para verificacao
		m_fim = int(str(linha[3])[5:7])
		#armazeno o mes inicial para comparacao
		m_inicio = int(str(linha[2])[5:7])
		# varial de armazenamento, contador
		dia_i = 0
		#verifica se o mes inicial é maior que o final, caso seja trata-se do mes anterior, entao automaticamente vai ser iniciado a conta do mes,
		# que foi passado como parametro 
		if m_inicio > m_fim:
			d_ini = 1

		#escreve na planilha o nome do docente na coluna 0, iniciando da celula A3
		planilha.write(row_now, 0, linha[0], style_name)
		#escreve na planilha o curso na coluna 3, iniciando da celula D3
		planilha.write(row_now, 3, linha[1], style_name)
		#enquanto o dia inicio for menor que o dia fim, vai ser escreito na planilha, de acorodo com os dias da semana que o docente estiver escalado.
		#print "dia ini: ",d_ini
		#print "dia fim: ",d_fim	
		while d_ini <= d_fim:
			#verifica qual é o dia da semana, retorna de 0 a 6, sendo que 0 eh segunda
			dia_i = calendar.weekday(int(ano), int(num_mes), int(d_ini))
			# verifica se o docente ta escalado esse dia, caso esteja, vai ser escrito na planilha
			if int(dia_semana[dia_i]) == 1:
				planilha.write(row_now, dic[d_ini][0] -2, str(linha[4]))
				planilha.write(row_now, dic[d_ini][1] -2, str(linha[5]))
				#itera para continuar o preenhimento de dias da semana de aconrodo com o horario
				d_ini +=1
				#print 'deu certo'
			else:
				#itera para continuar o preenhimento de dias da semana de aconrodo com o horario
				d_ini +=1
				#print 'falhou'
		# incrementa a varial para poder passar pra proxima linha		
		row_now +=1
	#fecha a conexao com o banco
	con.close()		


#try:

#a = input("Digite o ano a ser utilizado: ")
#m = input("Digite no numero correspondente ao seu mes: ")


form = cgi.FieldStorage()
ano = form.getvalue("ano", "(sem ano)")
a = cgi.escape(ano)
a = int(a)

p = form.getlist('mes')
#mm = cgi.escape(i)

p = list(p)
m = p#[5, 6, 7, 8, 9, 10, 11, 12]

for i in m:
	#print i
	criaPainel(a, int(i))


book.save(nome_arquivo)
#except Exception, e:
		#print e	
		#print "Unexpected error:", sys.exc_info()[0]
#except:
	#print "Unexpected error:", sys.exc_info()[0]

#print a
print """%s""" % (d)