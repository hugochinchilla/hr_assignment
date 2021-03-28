CREATE TABLE employees
(
    id BINARY(16) PRIMARY KEY,
    name VARCHAR(128) NOT NULL,
    salary INT UNSIGNED NOT NULL,
    department_id BINARY(16) NOT NULL,
    INDEX department_idx (department_id),
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE
) ENGINE=INNODB;
