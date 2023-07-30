# Deliveboo 
>deliveboo-back-end

`Deliveboo` è una web app che permette di ordinare cibo a domicilio.

Permette agli utenti di cercare i loro cibi preferiti, preparati dai loro ristoranti di fiducia. Tutto rimanendo comodamente sul divano di casa.

## Come installare

1. aprire il progetto su vscode
2. Aprire un nuovo terminare e digirate:
-  npm i
- composer install
3. Copiare il file .env, generare una nuova key da terminale e modificare il nome del db utilizzato;
- php artisan key:generate
4. Installare lo storage dove avverrà il salvataggio delle immagini;
- php artisan storage:link
5. Avviare il progetto
- npm run dev
- php artisan serve
6. Popolare il database
- php artisan migrate
- php artisan db:seed
7. Installare braintree per gestione pagamento
- composer require braintree/braintree_php
8. Aggiungere nel file .env
```
BT_ENVIROMENT="sandbox"
BT_MERCHANT_ID="n8xdsnzw7b8y6hx6"
BT_PUBLIC_KEY="jr4vtgmzpb4wyqqs"
BT_PRIVATE_KEY="82fabbba6dee3b83dd12f024d71cc04e"
```

## Struttra del progetto
- Dashboard per gli utenti registrati (ristoratori) accessibile tramite authentication login/register;
- Possibilità per gli utenti registrati di creare il proprio ristorante e di poterlo modificare in un secondo momento per aggiungere ulteriori informazioni direttamente da una pagina dedicata accessibile dal menu;
- Pagina Dashboard con statistiche relative agli ordini degli ultimi 7 giorni/ultimo mese/ultimo anno con ripilogo tot. ordini ricevuti, tot. piatti inseriti e tot. incasso;
- Pagina per creare nuovi piatti da aggiungere al menu;
- Pagina lista piatti con possibilità di cercare i piatti per nome,di modificarli, di vedere i dettagli del singolo piatto e di eliminarli;
- Possibilità di ripristinare un piatto già eliminato;
- Pagina ordini con riepilogo di tutti gli ordini ricevuti con all'interno i relativi dettagli del singolo ordine;

## Team

```
Pierdomenico Guarnieri
```
```
Daniele Spuria
```
```
Niccolò Vaccina
```
```
Emilio Federico
```
