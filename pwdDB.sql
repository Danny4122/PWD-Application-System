
-- ENUM Types
CREATE TYPE sex_enum AS ENUM ('Male', 'Female');
CREATE TYPE civil_status_enum AS ENUM ('Single', 'Married', 'Separated', 'Widow/er', 'Cohabitation');
CREATE TYPE application_type_enum AS ENUM ('New', 'Renewal', 'Lost ID');

-- APPLICANT TABLE
CREATE TABLE applicant (
    applicant_id SERIAL PRIMARY KEY,
    pwd_number VARCHAR(16),
    application_type application_type_enum,
    last_name VARCHAR(50),
    first_name VARCHAR(50),
    middle_name VARCHAR(50),
    suffix VARCHAR(10),
    birthdate DATE,
    sex sex_enum,
    civil_status civil_status_enum,
    house_no_street VARCHAR(100),
    barangay VARCHAR(50),
    municipality VARCHAR(50),
    province VARCHAR(50),
    region VARCHAR(50),
    landline_no VARCHAR(20),
    mobile_no VARCHAR(20),
    email_address VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- USER ACCOUNT TABLE (Applicant Login)
CREATE TABLE user_account (
    user_id SERIAL PRIMARY KEY,
    applicant_id INT NOT NULL UNIQUE REFERENCES applicant(applicant_id) ON DELETE CASCADE,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
