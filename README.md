# **PHP + MySQL CRUD Operations on Student Records**

## **Description**
A **PHP + MySQL** web application to perform **CRUD (Create, Read, Update, Delete)** operations on **Student Records** containing the following fields:

- **Name**
- **Email**
- **Course**
- **Marks**

---

## **Technologies Used**

- **PHP** — Backend logic and database interaction
- **MySQL (MariaDB)** — Database to store student records
- **HTML + CSS** — Frontend structure and styling
- **XAMPP** — Local development environment (Apache + MySQL)

---

## **Project Files**

| **File** | **Purpose** |
|---|---|
| **db.php** | Database connection configuration |
| **functions.php** | CRUD functions (add, read, update, delete) |
| **index.php** | Main web page — form and student table |
| **database.sql** | SQL script to create the database and table |

---

## **Screenshots**

### **Before Deleting**

<img width="600" alt="Before Deleting" src="https://github.com/user-attachments/assets/773b17a0-b920-4ec5-9cb8-7ea75846a9f4" />

<img width="600" alt="Student Table" src="https://github.com/user-attachments/assets/8df39378-a71d-4f8b-8be7-c8851ff9441a" />

---

### **After Deleting**

<img width="600" alt="After Deleting" src="https://github.com/user-attachments/assets/aa0883f8-510d-4a49-902b-d892d16295d5" />

---

### **Creating a Record**

<img width="600" alt="Creating a Student Record" src="https://github.com/user-attachments/assets/985e1ccf-33e5-4d3e-8a72-b1189936365f" />

---

### **After Creation**

<img width="600" alt="After Creation" src="https://github.com/user-attachments/assets/33a8c824-e13f-4cad-8374-472269fb7135" />

---

### **Before Updating**

<img width="600" alt="Before Updating" src="https://github.com/user-attachments/assets/597ee889-8c55-4bb8-b1bc-df63db919222" />

---

### **After Updating**

<img width="600" alt="After Updating" src="https://github.com/user-attachments/assets/c9cfaea4-e092-44ee-b910-85087ed1ce20" />

---

## **How to Run Locally**

1. **Install XAMPP** from [apachefriends.org](https://www.apachefriends.org)
2. **Start Apache and MySQL** in the XAMPP Control Panel
3. **Clone this repository** into `C:\xampp\htdocs\student-crud`
4. **Open phpMyAdmin** at `http://localhost/phpmyadmin`
5. **Run database.sql** in the SQL tab to create the database and table
6. **Open the app** at `http://localhost/student-crud/index.php`
