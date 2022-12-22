# HTTP Аутентификация
---
## Текст задания
### Цель работы
Спроектировать и разработать систему авторизации пользователей на протоколе HTTP

## Ход работы

Первоначально пользователь попадает на форму авторизации, вводит логин и пароль. В случае корректного ввода пользователь перенаправляется в свой профиль. Если пользователя с таким логином и паролем не существует, то он возвращается обратно на страницу авторизации с сообщением об ошибке. Если у пользователя еще нет аккаунта, то он может перейти по ссылке "зарегистрируйтесь" и зарегистрироваться.

В данном случае пользователь перенаправляется на страницу регистрации, где необходимо ввести ФИО, логин, почту, пароль (от 6 до 12 символов) и его подтверждение, секретное слово, а также добавить изображение профиля. В случае корректного ввода данных он перенаправляется на страницу с авторизацией. В противном случае пользователь возвращается обратно на страницу регистрации с сообщением о той или иной ошибке. Также есть возможность перейти на страницу авторизации, нажав на ссылку "авторизуйтесь", если у пользователя уже есть аккаунт.

Если пользователь забыл пароль от существующего аккаунта и не может войти, находясь на странице авторизации, то он может перейти по ссылке “Восстановить” и изменить пароль. В данном случае пользователь перенаправляется на страницу восстановления пароля, где ему необходимо ввести логин, секретное слово, которое пользователь вводил при регистрации, новый пароль, его подтверждение и нажать на кнопку “Изменить пароль”. В случае корректного ввода пользователь перенаправляется на страницу авторизации. Если же он ввел что-то неправильно, то возвращается на эту же страницу с сообщением об ошибке. Если пользователь случайно перешел по ссылке восстановления пароля, то он может нажать на ссылку “Авторизуйтесь”, которая вернет его обратно на страницу авторизации.

Если пользователь хочет сменить пароль, он может перейти по ссылке “Сменить пароль” и изменить пароль. В данном случае пользователь перенаправляется на страницу изменения пароля, где ему необходимо ввести логин, старый пароль, новый пароль и его подтверждение, после чего нажать “Изменить пароль”. В случае корректного ввода пользователь перенаправляется на страницу авторизации. Если же он ввел что-то неправильно, то возвращается на эту же страницу с сообщением об ошибке. Если пользователь случайно перешел по ссылке изменения пароля, то он может нажать на ссылку “Авторизуйтесь”, которая вернет его обратно на страницу авторизации.

На странице профиля у пользователя есть ссылка выхода из аккаунта “Выход”. Ссылка перенаправляет пользователя на форму входа, при этом он выходит из аккаунта. 

### 1) Пользовательские сценарии работы

![Пользовательские сценарии работы](пользовательские_сценарии.jpg)

2) API сервера и хореография\
![lr_1](хореография.png)

3) Структура БД

| id | login | email | password | secret_word |
| ------ | ------ | ------ | ------ | ------ |

- id : INT(11), PRIMARY KEY, AUTO_INCREMENT
(уникальный идентификатор пользователя)
- login : VARCHAR(250), по умолчанию NULL
(логин)
- email: VARCHAR(255), по умолчанию NULL
(почта)
pass: VARCHAR(500), по умолчанию NULL
(хешированный пароль)
- secret_word: VARCHAR(255), по умолчанию NULL
(хешированное секретное слово для восстановления пароля)

4) Алгоритмы

- регистация\
![алгоритмы_1](алгоритмы1.jpg)

- авторизация\
![алгоритмы_2](алгоритмы2.jpg)

- выход\
![алгоритмы_3](алгоритмы3.jpg)

- восстановление пароля\
![алгоритмы_4](алгоритмы_4.jpg)

- обновление пароля\
![алгоритмы_5](алгоритмы5.jpg)

# Примеры HTTP запросов/ответов

<br>GET /lr_1/profile.php HTTP/1.1
<br>Host: localhost
<br>Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
<br>sec-ch-ua: "Chromium";v="106", "Google Chrome";v="106", "Not;A=Brand";v="99"
<br>sec-ch-ua-mobile: ?0
<br>sec-ch-ua-platform: "Windows"
<br>Upgrade-Insecure-Requests: 1
<br>User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36

<br>HTTP/1.1 302 Found
<br>Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
<br>Connection: Keep-Alive
<br>Content-Length: 425
<br>Content-Type: text/html; charset=UTF-8
<br>Date: Thu, 27 Oct 2022 07:49:32 GMT
<br>Expires: Thu, 19 Nov 1981 08:52:00 GMT
<br>Keep-Alive: timeout=10, max=98
<br>Location: login.php
<br>Pragma: no-cache
<br>Server: Apache

<br>GET /lr_1/login.php HTTP/1.1
<br>Host: localhost
<br>Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
<br>sec-ch-ua: "Chromium";v="106", "Google Chrome";v="106", "Not;A=Brand";v="99"
<br>sec-ch-ua-mobile: ?0
<br>sec-ch-ua-platform: "Windows"
<br>Upgrade-Insecure-Requests: 1
<br>User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36

<br>HTTP/1.1 200 OK
<br>Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
<br>Connection: Keep-Alive
<br>Content-Length: 696
<br>Content-Type: text/html; charset=UTF-8
<br>Date: Thu, 27 Oct 2022 07:49:32 GMT
<br>Expires: Thu, 19 Nov 1981 08:52:00 GMT
<br>Keep-Alive: timeout=10, max=97
<br>Pragma: no-cache
<br>Server: Apache
