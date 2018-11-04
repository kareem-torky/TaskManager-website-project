
*** The site is still under construction ***
*** Some situations is being handled at the moment ***

1- To use the website you should import database.sql on phpmyadmin.

2- database.sql creates a db called "todo" with two tables "users" & "tasks".

3- session.php starts a session, it's included in every page.

3- connect.php connects to todo db using PDO, it's included in every page.

4- head.php contains html starting tag and head tags, it's included in every page.

5- closing.php contains html & body closing tags and some inclusions, it's included in every page.

6- the site consist of four pages : index, login, signup, home.

7- username and add to list fields are protected against XSS attacks using htmlspecialchars function.
passwords are hashed before storing in the db using password_hash function.

8- the site contains error messaging in login and sign up pages






