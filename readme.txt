PAGINA WEB CENTRALINA METEO STAZIONE DI MEDICINA

Overview

	La pagina html creata (index.html) visualizza i dati presenti sul database della macchina 192.167.189.101.
	I dati del DB rappresentano le letture dei dati meteo ad opera della centralina metereologica della stazione di Medicina.
	La pagina interroga il DB ad ogni refreshe, ad ogni resize e per ogni richiesta da parte di chi visualizza la pagina.
	La pagina poggia sul web server Apache2 e lavora in ridirezione attraverso Medgate.

Requisiti software

	Occore installare Apache2:

	 	sudo apt install apache2

	Non occorre configurazione particolare, il server opera sul localhost alla porta di default in HTTP.
	Dovrebbe poter lavorare senza problemi in HTTPS ma sono stati rilevati problemi quindi per ora il redirect avviene tramite HTTP.

	E' necessario però avere i file della pagina web nella cartella di default di Apache2(senza la cartella parent con il nome del repo git):
		
		/var/www/html/

Architettura pagina

	L'entry point è index.html.
	Questa utilizza script js per eseguire le query al DB.
	Gli script js sono collegati agli eventi resize e load nell'html e sono connessi ai pulsanti di richiesta dati presenti su ogni grafico disponibile.
	Il js costruisce le richieste o query al DB tramite l'utilizzo di file PHP.
	Gli sript PHP operano effettivamente la query al DB tramite username.
	Attualmente l'accesso con password è stata rimosso a causa di incompatibilità con il formato delle pwd nel DB.
	
