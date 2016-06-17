<?php

	require("./createConnection.php");

	//Clean User Table
	if($conn->query("truncate User") === TRUE){
		echo "User records deleted successfully <br/>";
	} else {
		echo "Error deleting User records: " . $conn->error . "<br/>";
	}


	$insertUserQuery = "INSERT INTO User (firstname, lastname, email, phone, password)
	VALUES('super', 'admin', 'admin@ist.utl.pt', '912345678', '21232f297a57a5a743894a0e4a801fc3')";

	if($conn->query($insertUserQuery) === TRUE){
		echo "User records inserted successfully <br/>";
	} else {
		echo "Error inserting User records: " . $conn->error . "<br/>";
	}
	
	//Clean Category Table
	if($conn->query("truncate Category") === TRUE){
		echo "Category records deleted successfully <br/>";
	} else {
		echo "Error deleting Category records: " . $conn->error . "<br/>";
	}

	$insertCategoryQuery = "INSERT INTO Category (name)
	VALUES('Culinária'),
	('Saúde'),
	('Tecnologia'),
	('Linguas'),
	('Casa')";

	if($conn->query($insertCategoryQuery) === TRUE){
		echo "Category records inserted successfully <br/>";
	} else {
		echo "Error inserting Category records: " . $conn->error . "<br/>";
	}
	
	//Clean Course Table
	if($conn->query("truncate Course") === TRUE){
		echo "Course records deleted successfully <br/>";
	} else {
		echo "Error deleting Course records: " . $conn->error . "<br/>";
	}
	
	$insertCourseQuery = "INSERT INTO Course (name, description, difficulty, popularity, author, creationDate, CategoryId, image)
	VALUES('Bacalhau Com Natas', 'O curso Bacalhau Com Natas ensina-lhe os princípios básicos de culinária sobre como preparar um excelente prato de Bacalhau Com Natas. É um curso introdutório, com vídeos e textos muito diretos e sempre com uma linguagem clara.', '1', '90', 'José Martins Soares', '2015-12-07 18:10:23', '1', 'img/bacalhau.jpg'),
	('Arroz de Pato', 'O curso Arroz de Pato ensina-lhe os princípios básicos de culinária sobre como preparar um excelente prato de Arroz de Pato. É um curso introdutório, com vídeos e textos muito diretos e sempre com uma linguagem clara.', '1', '90', 'Alberto Medeiros', '2015-12-07 18:10:23', '1', 'img/arroz.jpg'),
	('Bife Wellington', 'O curso Bife Wellington ensina-lhe os princípios básicos de culinária sobre como preparar um excelente prato de Bife Wellington. É um curso introdutório, com vídeos e textos muito diretos e sempre com uma linguagem clara.', '1', '90', 'Martin Serreira', '2015-12-07 18:10:23', '1', 'img/bife.jpg'),
	('Medir a Tensão', 'Este curso serve para ensinar os alunos a medir a sua própria tensão e explicar o conceito e para que serve.', '2', '60', 'Maria Ramos', '2015-12-07 18:10:23', '2', 'img/tensao.jpg'),
	('Diabetes Uma Segunda Vida', 'Este curso serve para ensinar os alunos a verificar se tem diabetes e explicar o conceito e as implicações do mesmo.', '2', '60', 'Leonardo Spinola', '2015-12-07 18:10:23', '2', 'img/diabetes.jpg'),
	('Do Stress ao Bem Estar', 'Sinta-se bem e seja mais produtivo através da gestão do stress. Tenha uma vida feliz e saudável, direcione o foco e cultive relações empáticas, aplicando ativamente as boas práticas que vai aprender. Este curso oferece-lhe ferramentas para gerir os seus níveis de stress e aumentar o seu bem-estar. Adquira hábitos e práticas simples, inspirados na prática da meditação mindfulness e no estudo de várias áreas da saúde, como a psicologia, as neurociências ou a medicina psicossomática, que têm revelado resultados comprovados e demonstrado um impacto positivo na saúde e na felicidade de quem já os adotou.', '2', '50', 'Vasco Gaspar', '2015-12-07 18:10:23', '2', 'img/stressfree.jpg'),
	('Robotica', 'Quer criar Robos? Então este curso é para si pois irá aprender a animar um robo e controla-lo tudo apartir do seu telemovel, mesmo que se encontre longe do robo em questão', '3', '80', 'Dr. Enrique Ruiz Velasco', '2015-12-07 18:10:23', '3', 'img/robotica.jpg'),
	('Produzir e Editar Video', 'O curso Produzir e editar vídeo foi criado para lhe ensinar a produzir conteúdos audiovisuais profissionais ou vídeos para mais tarde recordar. Ao longo de quatro módulos de aprendizagem, vai explorar as etapas do processo criativo de uma produção audiovisual, passar pela escolha do equipamento, pela composição de imagem e pelos momentos cruciais de captação e edição de vídeo. No final será capaz de dar asas à sua imaginação e criar um filme de qualidade.', '3', '60', 'Multimédia com Todos', '2015-12-07 18:10:23', '3', 'img/editarvideo.jpg'),
	('Design de Interação', 'Aprenda como desenhar tecnologias que trazem felicidade as pessoas, em vez de frustração. Voçê irá aprender como criar ideias para desings, tecnicas para desenvolvimento rapido e como utilizar esses prototipos para receber feedback', '3', '70', 'Scott Klemmer', '2015-12-07 18:10:23', '3', 'img/designint.jpg'),
	('Inglês', 'O Curso Inglês vai melhorar as suas competências comunicacionais em língua Inglesa. Este curso foi elaborado para quem tem um nível básico de inglês e tem como objetivo desenvolver a expressão oral e escrita, em língua inglesa, num contexto profissional. Os conteúdos foram concebidos a pensar nos profissionais que precisam de comunicar em Inglês. É indicado para quem pretende aperfeiçoar o idioma, enriquecer o vocabulário e abordar com confiança o próximo contacto em inglês com clientes, parceiros, fornecedores ou colegas.', '1', '60', 'Ana Dias', '2015-12-07 18:10:23', '4', 'img/ingles.jpg'),
	('Alemão', 'O Curso Alemão vai melhorar as suas competências comunicacionais em língua Alemã. Este curso foi elaborado para quem tem um nível básico de alemão e tem como objetivo desenvolver a expressão oral e escrita, em língua alemã, num contexto profissional. Os conteúdos foram concebidos a pensar nos profissionais que precisam de comunicar em Alemão. É indicado para quem pretende aperfeiçoar o idioma, enriquecer o vocabulário e abordar com confiança o próximo contacto em alemão com clientes, parceiros, fornecedores ou colegas.', '2', '50', 'Alexandra Ferreira', '2015-12-07 18:10:23', '4', 'img/alemao.jpg'),
	('Japonês', 'O Curso Japonês vai melhorar as suas competências comunicacionais em língua Japonesa. Este curso foi elaborado para quem tem um nível básico de japonês e tem como objetivo desenvolver a expressão oral e escrita, em língua japonesa, num contexto profissional. Os conteúdos foram concebidos a pensar nos profissionais que precisam de comunicar em Japonês. É indicado para quem pretende aperfeiçoar o idioma, enriquecer o vocabulário e abordar com confiança o próximo contacto em japonês com clientes, parceiros, fornecedores ou colegas.', '3', '60', 'António Sacavém', '2015-12-07 18:10:23', '4', 'img/japones.jpg'),
	('Jardinagem', 'No curso de Jardinagem o participante conhecerá os aspectos relacionados com as técnicas básicas para a montagem e manutenção de jardins. Será apresentado de forma breve um histórico acerca dos diferentes estilos de jardins existentes.', '2', '80', 'Alex Mitchell', '2015-12-07 18:10:23', '5', 'img/gardening.jpg'),
	('Bricolage', 'Já alguma vez tentou arranjar alguma coisa na sua casa? Reciclar um móvel, construir uma mesa ou uma cadeira? Talvez você esteja a usar bricolagem e nem sabe disso. O curso é dado por especialistas da Leroy Merlin sem qualquer custo para o aluno.', '3', '70', 'Leroy Merlin', '2015-12-07 18:10:23', '5', 'img/carpentry.jpg')";

	if($conn->query($insertCourseQuery) === TRUE){
		echo "Course records inserted successfully <br/>";
	} else {
		echo "Error inserting Course records: " . $conn->error . "<br/>";
	}
	
	//Clean Lesson Table
	if($conn->query("truncate Lesson") === TRUE){
		echo "Lesson records deleted successfully <br/>";
	} else {
		echo "Error deleting Lesson records: " . $conn->error . "<br/>";
	}
	
	$insertLessonQuery = "INSERT INTO Lesson (name, guide, video)
	VALUES('Introdução', 'Introdução ao tema do curso', 'img/bacalhau.jpg'),
	('Desfiar o Bacalhau', 'Esta lição vai prepara-lo para desfiar um Bacalhau como os melhores chefes de restaurantes de luxo.', 'img/bacalhau.jpg'),
	('Forno', 'Esta lição vai prepara-lo para todas as eventualidades de trabalhar com um forno na preparação de um delicioso Bacalhau Com Natas.', 'img/bacalhau.jpg'),
	('Introdução', 'Introdução ao tema do curso', 'img/arroz.jpg'),
	('Desfiar o Pato', 'Esta lição vai prepara-lo para desfiar um Pato como os melhores chefes de restaurantes de luxo.', 'img/arroz.jpg'),
	('Aperfeiçoar o Arroz', 'Esta lição vai prepara-lo para conseguir cozinhar qualquer tipo de arroz ao mais alto nivel como os melhores chefes de restaurantes de luxo.', 'img/arroz.jpg'),
	('Introdução', 'Introdução ao tema do curso', 'img/bife.jpg'),
	('Fazer a Massa', 'Esta lição vai prepara-lo para a preparação da massa necessária para cozinhar um delicioso Bife Wellington como os melhores chefes de restaurantes de luxo.', 'img/bife.jpg'),
	('Introdução', 'Introdução ao tema do curso', 'img/tensao.jpg'),
	('O que é a Tensão?', 'Esta lição vai ensinar-lhe todos os aspectos que precisa de saber para compreender o conceito de Tensão.', 'img/tensao.jpg'),
	('Avaliar Valores da Tensão', 'Esta lição vai mostrar-lhe os limites da Tensão e quando deve ter cuidado ou não segundo esses valores.', 'img/tensao.jpg'),
	('Introdução', 'Introdução ao tema do curso', 'img/diabetes.jpg'),
	('Evitar Diabetes', 'Esta lição ensina-lhe varios métodos para evitar ter diabetes e como comer uma alimentação saudável.', 'img/diabetes.jpg'),
	('Viver com Diabetes', 'Esta lição prepara-o para lidar com a doença Diabetes e como minimizar os seus efeitos ao longo do dia.', 'img/diabetes.jpg'),
	('Introdução', 'Introdução ao tema do curso', 'www.youtube.com/embed/MdJP0wg2_XM'),
	('Não vale de nada Queixar-se', 'Para além dos sentimentos dolorosos associados ao choque e à mágoa, o passo acelerado do mundo actual parece querer instalar o stress como característica permanente da vida moderna. Embora seja difícil de definir, o stress pode ser qualquer coisa que perturbe a sensação que se tem do bem-estar.', 'www.youtube.com/embed/QOLrayv2R2s'),
	('Introdução', 'Introdução ao tema do curso', 'img/robotica.jpg'),
	('Programação Android', 'Está quase a fazer um ano que a Google lançou o Android Studio – um IDE de programação para a plataforma Android. Este IDE é semelhante ao popular Eclipse, com ADT Plugin, oferecendo as melhores ferramentas e funcionalidades aos programadores. ', 'img/robotica.jpg'),
	('Programação iOS', 'O foco é criar uma aplicação que faz uso de muitos componentes visuais, armazenamento de dados, passando por dicas de Xcode que é o IDE oficial da Apple para desenvolvimento. Ao final do curso, você irá compreender os principais fundamentos da linguagem Objective-C, utilizada pelos frameworks de desenvolvimento para iOS bem como também verá a criação de telas com Swift, a nova linguagem de programação da Apple, integrando-as em um projeto com Objective-C.', 'img/robotica.jpg'),
	('Introdução', 'Introdução ao tema do curso', 'img/editarvideo.jpg'),
	('Princípios de sequência e lógica', 'A lógica examina de forma genérica as formas que a argumentação pode tomar, quais dessas formas são válidas e quais são falaciosas. Em filosofia, o estudo da lógica aplica-se na maioria dos seus principais ramos: metafísica, ontologia, epistemologia e ética.', 'img/editarvideo.jpg'),
	('Introdução', 'Introdução ao tema do curso', 'img/designint.jpg'),
	('Concepção Centrada no Utilizador', 'Apreender os princípios norteantes e as metodologias da concepção centrada no utilizador de sistemas interactivos. Apreender a necessidade do conhecimento dos utilizadores e suas necessidades e seu envolvimento na construção de sistemas interactivos. Adaptar estes conhecimentos a metodologias de desenvolvimento centrado no utilizador.', 'img/designint.jpg'),
	('Introdução', 'Introdução ao tema do curso', 'img/ingles.jpg'),
	('Inglês Básico', 'Esta lição irá prepara-lo para comunicar em Inglês a um nivel básico.', 'img/ingles.jpg'),
	('Introdução', 'Introdução ao tema do curso', 'img/alemao.jpg'),
	('Alemão Básico', 'Esta lição irá prepara-lo para comunicar em Alemão a um nivel básico.', 'img/alemao.jpg'),
	('Introdução', 'Introdução ao tema do curso', 'img/japones.jpg'),
	('Aprender Hiragana', 'Esta lição irá prepara-lo para comunicar em Japonês a um nivel básico.', 'img/japones.jpg'),
	('Introdução', 'Introdução ao tema do curso', 'www.youtube.com/embed/srU_UnK31iU'),
	('Painéis ou Jardins Verticais', 'Independentemente do tamanho do seu jardim, é possivel criar uma cultura cheia. Neste curso prático, pela escritora de jardinagem Alex Mitchell, irá descobrir quão facil é cultivar comida deliciosa para a sua mesa, mesmo sendo um completo novato em jardinagem.', 'www.youtube.com/embed/srU_UnK31iU'),
	('Introdução', 'Introdução ao tema do curso', 'www.youtube.com/embed/p9y6ruMc-jA'),
	('Aprenda a fazer arte em madeira', 'Os processos estão relacionados de forma direta com os conceitos de Faça você mesmo ou Do it Yourself (DIY), este que é um conceito criado nos Estados Unidos a partir da década de 1950. Em vários casos, os métodos de bricolagem funcionam como um tipo de hobby gerando momentos de grande prazer e satisfação em quem possa ao executar.', 'www.youtube.com/embed/p9y6ruMc-jA')";

	if($conn->query($insertLessonQuery) === TRUE){
		echo "Lesson records inserted successfully <br/>";
	} else {
		echo "Error inserting Lesson records: " . $conn->error . "<br/>";
	}
	
	//Clean Question Table
	if($conn->query("truncate Question") === TRUE){
		echo "Question records deleted successfully <br/>";
	} else {
		echo "Error deleting Question records: " . $conn->error . "<br/>";
	}

	$insertQuestionQuery = "INSERT INTO Question (question, correctAnswer, wrongAnswer1, wrongAnswer2, wrongAnswer3)
	VALUES('O que é um Projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é Avaliação Sistemica?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um Projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('Como é que a Psicologia social aborda a relação indivíduo-sociedade? ', 'Compreendendo o comportamento do homem', 'Testando as pessoas', 'Criando teorias', 'Magia'),
	('Como é que a Psicologia social aborda a relação indivíduo-sociedade? ', 'Compreendendo o comportamento do homem', 'Testando as pessoas', 'Criando teorias', 'Magia'),
	('Como é que a Psicologia social aborda a relação indivíduo-sociedade? ', 'Compreendendo o comportamento do homem', 'Testando as pessoas', 'Criando teorias', 'Magia'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é Stress?', 'Resposta biológica a algo', 'Uma forma de vida', 'Um trabalho', 'Uma dor de cabeça'),
	('Como se sentir bem?', 'Usar a aplicação OLE', 'Ser mal pago', 'Ver o Crepúsculo', 'Ver O Acontecimento'),
	('O que é um Robo?', 'Uma maquina automatizada', 'Um animal de estimação', 'Algo de um filme', 'Exterminador'),
	('O que é um Robo?', 'Uma maquina automatizada', 'Um animal de estimação', 'Algo de um filme', 'Exterminador'),
	('O que é um Robo?', 'Uma maquina automatizada', 'Um animal de estimação', 'Algo de um filme', 'Exterminador'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é um projecto?', 'Um plano e a sua execução', 'Uma forma de vida', 'Um trabalho', 'Um plano apenas'),
	('O que é Jardinagem?', 'Actividade Profisional ou Recreativa', 'Uma Ciência', 'Actividade Intelectual', 'Uma Terapia do Sono'),
	('Vantagem de um Jardim Vertical', 'Combater Aquecimento Global', 'Efeito Visual', 'Facilidade de Manutenção', 'Ser Vertical'),
	('O que é Bricolage?', 'Fazer pequenos Trabalhos', 'Um Ramo de Engenharia', 'Uma Arte Mágica', 'Decoração de Interiores'),
	('Qual a tinta indicada para pintar cadeiras?', 'Tintas em Spray', 'Tinta Aquosa', 'Tinta Epoxi', 'Tinta Para Madeira')";

	if($conn->query($insertQuestionQuery) === TRUE){
		echo "Question records inserted successfully <br/>";
	} else {
		echo "Error inserting Question records: " . $conn->error . "<br/>";
	}
	
	//Clean CourseLesson Table
	if($conn->query("truncate CourseLesson") === TRUE){
		echo "CourseLesson records deleted successfully <br/>";
	} else {
		echo "Error deleting CourseLesson records: " . $conn->error . "<br/>";
	}
	
	$insertCourseLessonQuery = "INSERT INTO CourseLesson (idCourse, idLesson)
	VALUES('1', '1'),
	('1', '2'),
	('1', '3'),
	('2', '4'),
	('2', '5'),
	('2', '6'),
	('3', '7'),
	('3', '8'),
	('4', '9'),
	('4', '10'),
	('4', '11'),
	('5', '12'),
	('5', '13'),
	('5', '14'),
	('6', '15'),
	('6', '16'),
	('7', '17'),
	('7', '18'),
	('7', '19'),
	('8', '20'),
	('8', '21'),
	('9', '22'),
	('9', '23'),
	('10', '24'),
	('10', '25'),
	('11', '26'),
	('11', '27'),
	('12', '28'),
	('12', '29'),
	('13', '30'),
	('13', '31'),
	('14', '32'),
	('14', '33')";

	if($conn->query($insertCourseLessonQuery) === TRUE){
		echo "CourseLesson records inserted successfully <br/>";
	} else {
		echo "Error inserting CourseLesson records: " . $conn->error . "<br/>";
	}
	
	//Clean LessonQuestion Table
	if($conn->query("truncate LessonQuestion") === TRUE){
		echo "LessonQuestion records deleted successfully <br/>";
	} else {
		echo "Error deleting LessonQuestion records: " . $conn->error . "<br/>";
	}
	
	$insertLessonQuestionQuery = "INSERT INTO LessonQuestion (idLesson, idQuestion)
	VALUES('1', '1'),
	('2', '2'),
	('3', '3'),
	('4', '4'),
	('5', '5'),
	('6', '6'),
	('7', '7'),
	('8', '8'),
	('9', '9'),
	('10', '10'),
	('11', '11'),
	('12', '12'),
	('13', '13'),
	('14', '14'),
	('15', '15'),
	('16', '16'),
	('17', '17'),
	('18', '18'),
	('19', '19'),
	('20', '20'),
	('21', '21'),
	('22', '22'),
	('23', '23'),
	('24', '24'),
	('25', '25'),
	('26', '26'),
	('27', '27'),
	('28', '28'),
	('29', '29'),
	('30', '30'),
	('31', '31'),
	('32', '32'),
	('33', '33')";

	if($conn->query($insertLessonQuestionQuery) === TRUE){
		echo "LessonQuestion records inserted successfully <br/>";
	} else {
		echo "Error inserting LessonQuestion records: " . $conn->error . "<br/>";
	}
	
	//Clean UserLesson Table
	if($conn->query("truncate UserLesson") === TRUE){
		echo "UserLesson records deleted successfully <br/>";
	} else {
		echo "Error deleting UserLesson records: " . $conn->error . "<br/>";
	}
	
	$insertUserLessonQuery = "INSERT INTO UserLesson (emailUser, idLesson, lessonCompleted)
	VALUES('admin@ist.utl.pt', '1', '0'),
	('admin@ist.utl.pt', '2', '0'),
	('admin@ist.utl.pt', '3', '0')";

	if($conn->query($insertUserLessonQuery) === TRUE){
		echo "UserLesson records inserted successfully <br/>";
	} else {
		echo "Error inserting UserLesson records: " . $conn->error . "<br/>";
	}

	require("./closeConnection.php");

?>