CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE applications (
    application_id INT AUTO_INCREMENT PRIMARY KEY
    student_id VARCHAR(50) NOT NULL,
    faculty VARCHAR(100) NOT NULL,
    course VARCHAR(100) NOT NULL,
    science_type VARCHAR(50),
    science_double_grade VARCHAR(10),
    biology_grade VARCHAR(10),
    physics_grade VARCHAR(10),
    chemistry_grade VARCHAR(10),
    maths_grade VARCHAR(10) NOT NULL,
    english_grade VARCHAR(10) NOT NULL,
    setswana_grade VARCHAR(10) NOT NULL,
    commerce_grade VARCHAR(10) NOT NULL,
    social_studies_grade VARCHAR(10) NOT NULL,
    agriculture_grade VARCHAR(10) NOT NULL,
    accounting_grade VARCHAR(10) NOT NULL,
    religious_education_grade VARCHAR(10) NOT NULL,
    additional_maths_grade VARCHAR(10) NOT NULL,
    geology_grade VARCHAR(10) NOT NULL,
    development_studies_grade VARCHAR(10) NOT NULL,
    computer_studies_grade VARCHAR(10) NOT NULL,
    documents TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    FOREIGN KEY (student_id) REFERENCES students(student_id),
);

