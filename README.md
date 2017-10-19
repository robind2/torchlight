# torchlight
Simple To-Do list in PHP, MySQL and jQuery

Dan Robinson, September 29, 2017
robind2@gmail.com

This project was completed using an AWS Free Tier EC2 instance, using a version of the LAMP stack that I installed. You can view the project here: 

http://18.220.26.74/todo

The project references a simple DB with a table 'todo' that holds todo task data. You can add a task with the 'Create Task' button, which will launch a modal window so you can enter the task data. From the task list view, you can move items up and down the list with the 'move up' and 'move down' buttons. These buttons will update the sequence in the database via an AJAX call, and re-display the list in the new order. 
