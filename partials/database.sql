CREATE TABLE users (
    doctorId CHAR(10) PRIMARY KEY,
    firstName VARCHAR(100) NOT NULL,
    middleName VARCHAR(100),
    lastName VARCHAR(100) NOT NULL,
    position ENUM('doctor', 'receptionist', 'admin') NOT NULL,
    address TEXT NOT NULL,
    dob DATE NOT NULL,
    primaryNumber CHAR(10) NOT NULL,
    primaryEmail VARCHAR(255) NOT NULL,
    secondaryNumber CHAR(10),
    secondaryEmail VARCHAR(255),
    salutation ENUM('Dr.', 'Mr.', 'Mrs.', 'Miss') NOT NULL,
    firstKinId INT NOT NULL,
    secondKinId INT,
    specialization VARCHAR(255),
    workingHoursWeekdays TEXT,
    workingHoursWeekends TEXT,
    salary DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (firstKinId) REFERENCES kin(id),
    FOREIGN KEY (secondKinId) REFERENCES kin(id)
);


INSERT INTO users (doctorId, firstName, middleName, lastName, position, address, dob, primaryNumber, primaryEmail, 
                   secondaryNumber, secondaryEmail, salutation, firstKinId, secondKinId, specialization, 
                   workingHoursWeekdays, workingHoursWeekends, salary) 
VALUES
('A123B45678', 'John', 'Michael', 'Doe', 'doctor', 'Nairobi, Kenya', '1980-03-25', '0712345678', 'john.doe@example.com', NULL, NULL, 'Dr.', 1, 2, 'Cardiology', '8 AM - 5 PM', '10 AM - 2 PM', 250000.00),
('B234C56789', 'Jane', NULL, 'Smith', 'receptionist', 'Mombasa, Kenya', '1992-07-15', '0723456789', 'jane.smith@example.com', '0710987654', 'jane.alt@example.com', 'Miss', 3, 4, NULL, '9 AM - 6 PM', '10 AM - 4 PM', 70000.00), ('C345D67890', 'Alice', 'Joy', 'Brown', 'admin', 'Kisumu, Kenya', '1985-11-30', '0734567890', 'alice.brown@example.com', NULL, NULL, 'Mrs.', 5, NULL, NULL, '8 AM - 4 PM', '9 AM - 1 PM', 150000.00),
('D456E78901', 'Peter', NULL, 'Mwaura', 'doctor', 'Nakuru, Kenya', '1978-05-20', '0745678901', 'peter.mwaura@example.com', '0711122233', NULL, 'Dr.', 6, 7, 'Dermatology', '7 AM - 3 PM', '8 AM - 12 PM', 230000.00),
('E567F89012', 'Lucy', 'Ann', 'Kamau', 'receptionist', 'Eldoret, Kenya', '1990-08-19', '0721234567', 'lucy.kamau@example.com', NULL, 'lucyk@example.com', 'Miss', 8, 9, NULL, '9 AM - 6 PM', '10 AM - 2 PM', 80000.00),
('F678G90123', 'James', NULL, 'Ochieng', 'admin', 'Thika, Kenya', '1983-01-12', '0712233445', 'james.ochieng@example.com', '0745566778', NULL, 'Mr.', 10, NULL, NULL, '8 AM - 5 PM', '9 AM - 3 PM', 140000.00),
('G789H01234', 'Grace', 'Faith', 'Odhiambo', 'doctor', 'Nairobi, Kenya', '1995-12-25', '0700112233', 'grace.odhiambo@example.com', NULL, NULL, 'Dr.', 11, 12, 'Pediatrics', '7 AM - 2 PM', '8 AM - 1 PM', 240000.00),
('H890I12345', 'Brian', NULL, 'Otieno', 'receptionist', 'Kakamega, Kenya', '1992-09-09', '0733445566', 'brian.otieno@example.com', '0745667788', 'brian.alt@example.com', 'Mr.', 13, 14, NULL, '10 AM - 7 PM', '11 AM - 3 PM', 75000.00),
('I901J23456', 'Sophia', 'Wanjiku', 'Ndungu', 'doctor', 'Nyeri, Kenya', '1987-06-06', '0711223344', 'sophia.ndungu@example.com', NULL, NULL, 'Dr.', 15, 16, 'Neurology', '7 AM - 5 PM', '9 AM - 1 PM', 260000.00),
('J012K34567', 'Caleb', NULL, 'Kiptoo', 'admin', 'Kericho, Kenya', '1990-02-17', '0722334455', 'caleb.kiptoo@example.com', '0733445566', NULL, 'Mr.', 17, NULL, NULL, '8 AM - 4 PM', '10 AM - 2 PM', 160000.00);
('K345L56789', 'Emily', 'Jane', 'Mwangi', 'doctor', 'Karen, Nairobi, Kenya', '1991-04-15', '0711223345', 'emily.mwangi@example.com', NULL, NULL, 'Dr.', 1, 2, 'Gynecology', '7 AM - 4 PM', '9 AM - 2 PM', 245000.00),
('L456M67890', 'David', NULL, 'Kamau', 'receptionist', 'Westlands, Nairobi, Kenya', '1993-07-20', '0712345678', 'david.kamau@example.com', '0745671234', NULL, 'Mr.', 3, 4, NULL, '8 AM - 6 PM', '10 AM - 3 PM', 85000.00),
('M567N78901', 'Cynthia', 'Faith', 'Kariuki', 'admin', 'Kikuyu, Kiambu, Kenya', '1985-10-10', '0700223344', 'cynthia.kariuki@example.com', NULL, NULL, 'Mrs.', 5, NULL, NULL, '9 AM - 5 PM', '10 AM - 2 PM', 140000.00),
('N678O89012', 'Patrick', NULL, 'Ndungu', 'doctor', 'Mombasa, Kenya', '1978-12-22', '0722334455', 'patrick.ndungu@example.com', NULL, 'patrick.alt@example.com', 'Dr.', 6, 7, 'Orthopedics', '7 AM - 3 PM', '9 AM - 1 PM', 275000.00),
('O789P90123', 'Rose', NULL, 'Omondi', 'receptionist', 'Kisumu, Kenya', '1990-03-05', '0733445566', 'rose.omondi@example.com', NULL, NULL, 'Miss', 8, 9, NULL, '9 AM - 6 PM', '10 AM - 3 PM', 75000.00),
('P890Q01234', 'Ian', NULL, 'Ochieng', 'admin', 'Nakuru, Kenya', '1982-09-19', '0744556677', 'ian.ochieng@example.com', '0711223344', NULL, 'Mr.', 10, NULL, NULL, '8 AM - 5 PM', '9 AM - 2 PM', 155000.00),
('Q901R12345', 'Diana', 'Elizabeth', 'Mumo', 'doctor', 'Machakos, Kenya', '1989-06-30', '0723456789', 'diana.mumo@example.com', NULL, NULL, 'Dr.', 11, 12, 'Cardiology', '6 AM - 2 PM', '8 AM - 12 PM', 265000.00),
('R012S23456', 'Victor', NULL, 'Mutua', 'receptionist', 'Thika, Kenya', '1992-11-15', '0700112233', 'victor.mutua@example.com', '0733445566', NULL, 'Mr.', 13, 14, NULL, '10 AM - 7 PM', '11 AM - 3 PM', 80000.00),
('S123T34567', 'Linda', NULL, 'Njuguna', 'doctor', 'Nyeri, Kenya', '1994-02-25', '0712345678', 'linda.njuguna@example.com', NULL, NULL, 'Dr.', 15, 16, 'Pediatrics', '7 AM - 4 PM', '9 AM - 1 PM', 235000.00),
('T234U45678', 'Calvin', 'James', 'Mburu', 'admin', 'Eldoret, Kenya', '1980-08-10', '0744556677', 'calvin.mburu@example.com', '0700112233', NULL, 'Mr.', 17, NULL, NULL, '8 AM - 4 PM', '10 AM - 2 PM', 150000.00),
('U345V56789', 'Anne', NULL, 'Kiplagat', 'doctor', 'Kericho, Kenya', '1986-12-11', '0733224455', 'anne.kiplagat@example.com', NULL, NULL, 'Dr.', 18, 19, 'Neurology', '6 AM - 3 PM', '8 AM - 12 PM', 280000.00),
('V456W67890', 'Brian', 'Michael', 'Odhiambo', 'receptionist', 'Kakamega, Kenya', '1990-01-01', '0722113344', 'brian.odhiambo@example.com', '0711445566', NULL, 'Mr.', 20, 21, NULL, '9 AM - 6 PM', '10 AM - 3 PM', 80000.00),
('W567X78901', 'Faith', NULL, 'Njoroge', 'admin', 'Kitale, Kenya', '1984-07-14', '0745667788', 'faith.njoroge@example.com', '0733445566', NULL, 'Miss', 22, NULL, NULL, '8 AM - 5 PM', '9 AM - 2 PM', 145000.00),
('X678Y89012', 'Samuel', NULL, 'Waweru', 'doctor', 'Naivasha, Kenya', '1993-04-25', '0700998877', 'samuel.waweru@example.com', NULL, NULL, 'Dr.', 23, 24, 'Radiology', '7 AM - 4 PM', '9 AM - 1 PM', 250000.00),
('Y789Z90123', 'Alice', NULL, 'Omondi', 'receptionist', 'Homa Bay, Kenya', '1991-05-20', '0721445566', 'alice.omondi@example.com', '0745778899', NULL, 'Mrs.', 25, 26, NULL, '10 AM - 7 PM', '11 AM - 3 PM', 70000.00),
('Z890A01234', 'Grace', 'Joy', 'Mutua', 'doctor', 'Meru, Kenya', '1992-12-09', '0711667788', 'grace.mutua@example.com', NULL, NULL, 'Dr.', 27, 28, 'Ophthalmology', '6 AM - 3 PM', '8 AM - 12 PM', 265000.00),
('A901B12345', 'Paul', 'Andrew', 'Kariuki', 'admin', 'Embu, Kenya', '1983-03-18', '0744556677', 'paul.kariuki@example.com', '0700112233', NULL, 'Mr.', 29, NULL, NULL, '8 AM - 5 PM', '9 AM - 3 PM', 150000.00),
('B012C23456', 'Monica', NULL, 'Mwenda', 'doctor', 'Isiolo, Kenya', '1988-09-30', '0733556677', 'monica.mwenda@example.com', NULL, NULL, 'Dr.', 30, 31, 'Dentistry', '7 AM - 2 PM', '8 AM - 12 PM', 270000.00),
('C123D34567', 'Esther', NULL, 'Nthenge', 'receptionist', 'Nanyuki, Kenya', '1995-01-29', '0711223344', 'esther.nthenge@example.com', '0722113344', NULL, 'Miss', 32, 33, NULL, '9 AM - 6 PM', '10 AM - 3 PM', 75000.00),
('D234E45678', 'George', 'Robert', 'Kimani', 'doctor', 'Kilifi, Kenya', '1987-11-11', '0700112233', 'george.kimani@example.com', NULL, NULL, 'Dr.', 34, 35, 'Surgery', '6 AM - 3 PM', '8 AM - 12 PM', 285000.00);


CREATE TABLE appointments (
    appointmentId VARCHAR(10) PRIMARY KEY,               -- appointmentId as a mix of characters and numbers
    patientFirstName VARCHAR(100) NOT NULL,              -- Patient's first name
    patientLastName VARCHAR(100) NOT NULL,               -- Patient's last name
    patientEmail VARCHAR(100) NOT NULL,                  -- Patient's email
    phoneNumber VARCHAR(20) NOT NULL,                    -- Patient's phone number
    yob INT NOT NULL,                                    -- Year of birth (yob)
    visitFor VARCHAR(255) NOT NULL,                      -- Procedure the patient has come for
    doctorId INT,                                        -- Foreign key referencing doctor
    dateCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,     -- Date when the appointment was created
    status ENUM('New', 'Approved', 'Cancelled') NOT NULL, -- Status of the appointment
    dateOfAppointment DATE NULL,                         -- Date of appointment (can be null)
    timeOfAppointment TIME NULL,                         -- Time of appointment (can be null)
    doctorNote TEXT,                                     -- Additional note from the doctor
    FOREIGN KEY (doctorId) REFERENCES users(doctorId)         -- Foreign key reference to the user's table (doctor's table)
);

-- Fix: Add DEFAULT CURRENT_TIMESTAMP to dateCreated column in appointments table
ALTER TABLE appointments MODIFY COLUMN dateCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

INSERT INTO appointments (appointmentId, patientFirstName, patientLastName, patientEmail, phoneNumber, yob, visitFor, doctorId, status, dateOfAppointment, timeOfAppointment, doctorNote)
VALUES
('A12345678', 'John', 'Doe', 'john.doe@example.com', '123-456-7890', 1990, 'General Checkup', 1, 'New', '2024-12-15', '09:00', 'Routine checkup for overall health'),
('B98765432', 'Jane', 'Smith', 'jane.smith@example.com', '987-654-3210', 1985, 'Dental Cleaning', 2, 'Approved', '2024-12-16', '10:00', 'Routine dental cleaning'),
('C24681357', 'Michael', 'Johnson', 'michael.johnson@example.com', '555-123-4567', 1978, 'Knee Surgery', 3, 'Cancelled', NULL, NULL, 'Patient cancelled the appointment'),
('D47892017', 'Emily', 'Davis', 'emily.davis@example.com', '555-765-4321', 1992, 'Eye Exam', 4, 'New', '2024-12-18', '11:00', 'Annual eye checkup'),
('E56473820', 'David', 'Williams', 'david.williams@example.com', '555-987-6543', 1980, 'Heart Checkup', 5, 'Approved', '2024-12-19', '14:00', 'Routine heart health checkup'),
('F12345679', 'Laura', 'Martinez', 'laura.martinez@example.com', '555-321-4321', 1995, 'Physiotherapy', 1, 'New', '2024-12-20', '08:00', 'Post-injury physiotherapy'),
('G98765430', 'Chris', 'Brown', 'chris.brown@example.com', '555-654-3210', 1988, 'Orthopedic Consultation', 2, 'Approved', '2024-12-21', '13:00', 'Consultation for knee pain'),
('H76543210', 'Sarah', 'Taylor', 'sarah.taylor@example.com', '555-876-5432', 1993, 'Dental Checkup', 3, 'Cancelled', NULL, NULL, 'Patient cancelled dental checkup'),
('I24681358', 'Daniel', 'Anderson', 'daniel.anderson@example.com', '555-987-1234', 1985, 'Back Pain Treatment', 4, 'New', '2024-12-22', '15:00', 'Treatment for chronic back pain'),
('J11223344', 'Sophia', 'Thomas', 'sophia.thomas@example.com', '555-456-7891', 1991, 'Maternity Checkup', 5, 'Approved', '2024-12-23', '09:30', 'Pregnancy checkup'),
('K12398765', 'James', 'Jackson', 'james.jackson@example.com', '555-234-5678', 1982, 'Skin Check', 1, 'New', '2024-12-24', '11:00', 'Skin cancer screening'),
('L98765431', 'Olivia', 'White', 'olivia.white@example.com', '555-876-5430', 1994, 'Cataract Surgery', 2, 'Approved', '2024-12-25', '10:00', 'Surgical procedure to remove cataract'),
('M24681359', 'Benjamin', 'Harris', 'benjamin.harris@example.com', '555-654-1234', 1989, 'Joint Replacement', 3, 'Cancelled', NULL, NULL, 'Patient cancelled joint replacement surgery'),
('N76543211', 'Isabella', 'Clark', 'isabella.clark@example.com', '555-321-7654', 1996, 'Flu Vaccination', 4, 'New', '2024-12-26', '08:00', 'Annual flu vaccination'),
('O12345680', 'Matthew', 'Lopez', 'matthew.lopez@example.com', '555-654-7890', 1992, 'Lung Checkup', 5, 'Approved', '2024-12-27', '12:00', 'Routine lung checkup'),
('P98765432', 'Ethan', 'Lewis', 'ethan.lewis@example.com', '555-987-6544', 1987, 'Weight Loss Consultation', 1, 'New', '2024-12-28', '13:00', 'Consultation for weight loss'),
('Q24681360', 'Ava', 'Walker', 'ava.walker@example.com', '555-321-8765', 1993, 'Asthma Treatment', 2, 'Approved', '2024-12-29', '09:30', 'Consultation for asthma treatment'),
('R76543212', 'Liam', 'Allen', 'liam.allen@example.com', '555-432-5678', 1990, 'Blood Pressure Monitoring', 3, 'Cancelled', NULL, NULL, 'Patient did not show up for appointment'),
('S12345681', 'Charlotte', 'Young', 'charlotte.young@example.com', '555-765-4329', 1995, 'Hearing Test', 4, 'New', '2024-12-30', '14:00', 'Routine hearing test'),
('T98765433', 'Lucas', 'King', 'lucas.king@example.com', '555-543-2109', 1983, 'Chronic Pain Management', 5, 'Approved', '2024-12-31', '10:30', 'Management of chronic pain'),
('U24681361', 'Amelia', 'Scott', 'amelia.scott@example.com', '555-432-8901', 1994, 'Mental Health Consultation', 1, 'New', '2025-01-02', '16:00', 'Consultation for mental health issues'),
('V76543213', 'Mason', 'Green', 'mason.green@example.com', '555-987-7650', 1986, 'Chronic Headache Consultation', 2, 'Approved', '2025-01-03', '11:00', 'Consultation for chronic headache'),
('W12345682', 'Ella', 'Adams', 'ella.adams@example.com', '555-234-8765', 1992, 'Orthopedic Surgery', 3, 'Cancelled', NULL, NULL, 'Patient cancelled surgery'),
('X98765434', 'Oliver', 'Nelson', 'oliver.nelson@example.com', '555-876-0987', 1989, 'Diabetes Management', 4, 'New', '2025-01-05', '10:30', 'Consultation for diabetes management'),
('Y24681362', 'Sophia', 'Carter', 'sophia.carter@example.com', '555-654-3211', 1987, 'Eye Surgery', 5, 'Approved', '2025-01-06', '12:00', 'Surgical procedure for eye treatment'),
('Z76543214', 'Henry', 'Mitchell', 'henry.mitchell@example.com', '555-321-8902', 1984, 'Gastrointestinal Treatment', 1, 'New', '2025-01-07', '09:00', 'Consultation for gastrointestinal issues'),
('A12398766', 'Grace', 'Perez', 'grace.perez@example.com', '555-987-1235', 1991, 'Pregnancy Ultrasound', 2, 'Approved', '2025-01-08', '13:30', 'Routine ultrasound during pregnancy'),
('B24681363', 'Megan', 'Roberts', 'megan.roberts@example.com', '555-654-0987', 1990, 'Cardiology Checkup', 3, 'Cancelled', NULL, NULL, 'Patient cancelled cardiology checkup'),
('C76543215', 'Jackson', 'Hernandez', 'jackson.hernandez@example.com', '555-765-9876', 1993, 'Cancer Screening', 4, 'New', '2025-01-10', '08:00', 'Routine cancer screening'),
('D12345683', 'Lily', 'Moore', 'lily.moore@example.com', '555-987-6549', 1986, 'Sports Injury Consultation', 5, 'Approved', '2025-01-12', '14:00', 'Consultation for sports-related injury'),
('E24681364', 'William', 'King', 'william.king@example.com', '555-432-1235', 1995, 'Allergy Testing', 1, 'New', '2025-01-13', '16:30', 'Allergy test to identify allergens'),
('F76543216', 'Jack', 'Lee', 'jack.lee@example.com', '555-321-7650', 1983, 'Sleep Study', 2, 'Approved', '2025-01-14', '10:00', 'Study for sleep disorders'),
('G12345684', 'Mia', 'Lopez', 'mia.lopez@example.com', '555-876-5436', 1992, 'Weight Loss Consultation', 3, 'Cancelled', NULL, NULL, 'Patient rescheduled weight loss consultation');


CREATE TABLE procedures (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Auto-generated random id
    procedureName VARCHAR(255) NOT NULL,     -- Procedure name
    dateCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date the procedure was created
    doctorId INT,                       -- Foreign key linked to the 'users' table (doctorId will reference users table)
    status ENUM('available', 'discontinued', 'paused') NOT NULL, -- Status of the procedure
    description TEXT
);

INSERT INTO procedures (procedureName, doctorId, status, description) VALUES
('Orthopedics', 1, 'available', 'Orthopedics focuses on the diagnosis, treatment, and prevention of musculoskeletal disorders, including bone, joint, and muscle conditions. It involves surgical and non-surgical methods to treat fractures, injuries, and deformities. Orthopedic surgeons use various techniques, such as joint replacement and arthroscopy.'),
('Obstetrics & Gynaecology', 2, 'available', 'Obstetrics & Gynaecology is a medical specialty that focuses on pregnancy, childbirth, and the female reproductive system. Obstetricians manage prenatal and postnatal care, while gynaecologists treat disorders of the reproductive organs.'),
('Dermatology', 3, 'available', 'Dermatology is the branch of medicine that deals with the skin, hair, and nails. Dermatologists treat conditions like acne, eczema, psoriasis, and skin cancer. They also perform cosmetic procedures such as botox and laser treatments.'),
('Paediatrics', 4, 'available', 'Paediatrics is the branch of medicine that involves the medical care of infants, children, and adolescents. Paediatricians diagnose and treat childhood illnesses, growth disorders, and development concerns.'),
('General Surgery', 5, 'available', 'General Surgery includes a wide range of surgical procedures to treat injuries, diseases, and other medical conditions. Surgeons in this field perform operations like appendectomy, hernia repairs, and gallbladder removals.'),
('Urology', 6, 'available', 'Urology is the branch of medicine that focuses on the urinary tract system and male reproductive organs. Urologists treat conditions like kidney stones, bladder infections, prostate cancer, and urinary incontinence.'),
('ENT', 7, 'available', 'ENT (Ear, Nose, and Throat) specialists diagnose and treat conditions related to the head and neck, including hearing loss, sinusitis, and throat disorders. They perform surgeries like tonsillectomies and cochlear implants.'),
('Dental', 8, 'available', 'Dental care includes the prevention, diagnosis, and treatment of oral health issues. Dentists manage procedures such as teeth cleanings, fillings, root canals, and cosmetic dental work like veneers and whitening.');


CREATE TABLE procedure_doctor (
    procedure_id INT,
    doctor_id INT,
    FOREIGN KEY (procedure_id) REFERENCES procedures(id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE,
    PRIMARY KEY (procedure_id, doctor_id)
);


CREATE TABLE usertypes (
    userTypeId INT AUTO_INCREMENT PRIMARY KEY,
    userTypeName VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL,
    total INT DEFAULT 0
);

-- Insert default user types with descriptions
INSERT INTO usertypes (userTypeName, description)
VALUES 
    ('Admin', 'System administrator with full access to manage the platform.'),
    ('Doctor', 'Healthcare professional responsible for patient care.'),
    ('Receptionist', 'Front desk staff handling appointments and inquiries.');

UPDATE usertypes u
SET u.total = (
    SELECT COUNT(*)
    FROM users us
    WHERE us.position = u.userTypeName
);

/* This trigger ensures the total column in usertypes stays up-to-date as users are added or removed */
/* MariaDB doesn't support multi-statement triggers in the same way other SQL databases do */
/* The DELIMITER $$ and DELIMITER ; are used to change the default statement delimiter to $$ 
so that the END statement in the trigger is not misinterpreted as the end of the SQL script */
DELIMITER $$

CREATE TRIGGER update_user_count
AFTER INSERT ON users
FOR EACH ROW
BEGIN
    UPDATE usertypes u
    SET u.total = (
        SELECT COUNT(*)
        FROM users us
        WHERE us.position = u.userTypeName
    );
END $$

DELIMITER ;

