# Kopiowanie repozytorium

git clone https://github.com/pyzaentomologist/symfony-app

# otwarcie katalogu projektu

cd symfony-app/symfony-app

# uruchomienie kontenera

docker-compose up -d

# Utworzenie pliku z lokalną zmienną .env-local

W .env-local

###> symfony/mailer ###

# MAILER_DSN=smtp://null

###< symfony/mailer ###

# MAILER_DSN=smtp://twojadres@gmail.com:kodautoryzacjigmail@smtp.gmail.com:587

###< symfony/mailer ###

# kodautoryzacjigmail - pozyskany z udostępnionej przez gmail funkcji wysyłek z prywatnego adresu mailowego: włączenie usługi Hasło do aplikacji:

# Konto google -> bezpieczeństwo -> weryfikacja dwuetapowa -> hasła do aplikacji:

https://myaccount.google.com/apppasswords

# MAILER_ADDRESS=twojadres@gmail.com

# uruchomienie dev w trybie watch - kompilacja plików js przy każdej zmianie

docker-compose exec app npm run watch

# port 8080

localhost:8080
