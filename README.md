# Clinic Management System

This is a **Clinic Management System** developed using **PHP Native 8**, **Bootstrap 5**, **Font Awesome**, and **SweetAlert2**. The system is designed to manage clinic operations for multiple roles, including doctors, administration, pharmacists, owners, and super admins.

## Features

1. **New Patient Registration**  
   Register new patients into the clinic system with detailed information.
   
2. **Patient Data Management**  
   Maintain and manage comprehensive patient records.

3. **Outpatient Registration**  
   Enroll patients for outpatient services.

4. **Initial Assessment Process**  
   Record the initial examination details such as height, weight, complaints, blood pressure, and other vital signs.

5. **Prescription Issuance**  
   Doctors can issue prescriptions directly through the system after the assessment.

6. **Medical Action Records**  
   Track and log the actions taken during patient treatment.

7. **Invoice Calculation**  
   Automatically calculate the total invoice based on prescription costs and medical actions.

8. **Pharmacist Prescription View**  
   Pharmacists can view the prescriptions required by patients immediately after being prescribed by the doctor.

9. **Payment and Billing**  
   After prescription fulfillment, the administration can generate an invoice for the patient and print the payment receipt.

10. **Detailed Receipt Printing**  
    Print a detailed receipt including drug details, actions taken, total payments, and any change returned to the patient.

11. **Patient Medical Records**  
    Store all patient assessment data in a medical record including examination details, prescribed medications, and actions taken.

12. **Referral Letter Generation**  
    If further treatment is required, doctors can generate a referral letter that includes patient information, hospital details, complaints, initial diagnosis, medications, and actions taken during the assessment.

## Technologies Used

- **PHP Native 8**: Backend development and server-side scripting.
- **Bootstrap 5**: Frontend framework for responsive design.
- **Font Awesome**: Icon library for enhanced UI/UX.
- **SweetAlert2**: Beautiful alerts and popups for user interactions.

## Installation

1. Clone this repository:
   ```bash
   git clone https://github.com/yourusername/clinic-management-system.git
2. Navigate to the project directory:
   ```bash
   cd clinic-management-system
3. Set up your database and import the necessary SQL files.
4. Configure the database connection in the project :
   - Open koneksi.php and set your database credentials.
5. Run the project on your local server using XAMPP or any other PHP server.

## Usage

- Access the application on your browser by navigating to http://localhost/Klinik-Mandiri.
- Login with the provided credentials or create a new user through the database.
- The application supports different roles (doctor, administration, pharmacist, owner, super admin) with role-based access to specific features.
