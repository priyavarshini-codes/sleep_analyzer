# Sleep Quality Analyzer

A web-based Sleep Quality Analyzer application developed using PHP and MySQL to evaluate users’ sleep patterns through a structured questionnaire and generate analytical results.


## Project Overview

The Sleep Quality Analyzer allows users to:

- Register and login securely

- Take a sleep assessment questionnaire

- View calculated sleep quality results

- Track previous assessments

- Logout securely

An admin module is also implemented to manage system functionality and monitor assessments.


## User Module Features

- User Registration & Login

- Sleep Assessment Questionnaire

- Automatic Result Calculation

- View Sleep History

- Session-based Authentication


## Admin Module Features

- Admin Login

- Manage Questions (Add / View)

- Monitor User Assessments

- View User History

- Secure Logout


## Database Design

The system uses a relational database with the following tables:

1. 'users' – Stores user information

2. 'admin' – Stores admin credentials

3. 'questions' – Stores questionnaire data

4. 'sleep_assessments' – Stores user responses

5. 'sleep_results' – Stores calculated results


## Technologies Used

- Backend: PHP

- Database: MySQL  

- Frontend: HTML5, CSS3, JavaScript

- Server: XAMPP (Apache Server)


## How to Run the Project

1. Install XAMPP.
   
2. Clone the repository:
   git clone https://github.com/priyavarshini-codes/sleep_analyzer.git
   
3. Move the project folder to
   C:\xampp\htdocs\

4. Start Apache and MySQL.
   
5. Import the database file (sleep_analyzer.sql) in phpMyAdmin.
    
6. Open browser and run:
   http://localhost/sleep_analyzer


## Future Improvements

- Data visualization using charts

- Enhanced password encryption

- Email notifications

- Responsive mobile UI

- Deployment on live server
