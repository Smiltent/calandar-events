<h1 align="center">Calendar Events</h1>
<p align="center"><em>A page where you can view Events on a Calendar</em></p>

> [!WARNING]
> This project is still under development. 

## What is this project?
A simple event calendar application, to help learn and understand database functionality in PHP. This project was initially started as a **summer assignment** by one of our teachers.

## Features (WIP)
* View events on a monthly calendar
* Add new events with a title, date, and description
* Administrator role system, to allow specific users to make and edit events
* Having a calendar, to preview all available events
* Secure interaction with the MySQL database using `mysql_pdo`

## How to run?
### Dependancies
```bash
sudo apt-get install docker git docker-compose-plugin
# if you dont have docker enabled
sudo systemctl enable docker --now
```
### Starting
*Before you start it, make sure you have changed .env.example to .env & you've changed the values*
```bash
# In the folder where the docker-compose.yml is located at
sudo docker compose up -d
```

## TODO
* Having a way to make/modify events as an admin
* Having a way to make/modify users as an admin
* Make first account always admin, instead of modifying `.env` to make a new user
* Show events in the calendar
* Show the upcoming events in the Upcoming Events section
* When you click on an event, it will give you send you to `/preview.php?id={id}`, to see the event's description and any other info
* Make [Replit](https://replit.com/) support, as I am only supporting Docker
* Add support for [Turnstile](https://www.cloudflare.com/application-services/products/turnstile/) or [reCaptcha](https://developers.google.com/recaptcha/)
* Dark mode

## License
[MIT License](LICENSE)
