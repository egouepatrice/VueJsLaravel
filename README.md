## Introduction
This application was designed with Laravel 6.2 and VueJs 2.5.17.
It allows the creation of resources through the following features:  

1. PDF download
Administration part: Entry for the title and file download dialog.
files.
Visitor part: Clickable link to download a file.

2. HTML extracts
Administration part: Entry for the title, text area for the description of the extract, and
and a place to enter the HTML excerpt.
Visitor part: Displays the description, the HTML snippet and the button to copy
the HTML snippet to the clipboard.

3. Link
Administration part: Entry for the title, entry for the link, checkbox
"Open in a new tab".
Visitor part: Clickable link that should open the page in the same tab or in a
in a new tab.

## Installation : 

Do after retrieving the repository: 

1- Update laravel with the command: "<code>composer update</code>".  
2- Update npm dependencies : "<code>npm install</code>". 

3- Load the mysql database with the file "testvuelaravel.sql" located at the root of the repository

4- Access the administration part with the uri "<code>/admin</code>"  <br>And to the visitor part with simply launching the application
   
And enjoy your application.


## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
