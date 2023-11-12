<?php
// Клас Співробітник
class Employee {
    private $position;
    private $salary;

    public function __construct($position, $salary) {
        $this->position = $position;
        $this->salary = $salary;
    }

    public function getPosition() {
        return $this->position;
    }

    public function getSalary() {
        return $this->salary;
    }

    // Дозволяє відвідувачеві обробити співробітника
    public function accept(Visitor $visitor) {
        $visitor->visitEmployee($this);
    }
}

// Клас Департамент
class Department {
    private $employees;

    public function __construct(array $employees) {
        $this->employees = $employees;
    }

    public function getEmployees() {
        return $this->employees;
    }

    // Дозволяє відвідувачеві обробити департамент
    public function accept(Visitor $visitor) {
        $visitor->visitDepartment($this);
    }
}

// Клас Компанія
class Company {
    private $departments;

    public function __construct(array $departments) {
        $this->departments = $departments;
    }

    public function getDepartments() {
        return $this->departments;
    }

    // Дозволяє відвідувачеві обробити компанію
    public function accept(Visitor $visitor) {
        $visitor->visitCompany($this);
    }
}

// Інтерфейс Відвідувача
interface Visitor {
    public function visitCompany(Company $company);
    public function visitDepartment(Department $department);
    public function visitEmployee(Employee $employee);
}

// Клас для створення репортів
class SalaryReportVisitor implements Visitor {
    private $report = [];

    public function visitCompany(Company $company) {        
        $this->report[] = "\nЗарплатна відомість для компанії: ";
        foreach ($company->getDepartments() as $department) {
            $this->report[] = "\n\tЗарплатна відомість для департаменту: ";
        
            foreach ($department->getEmployees() as $employee) {
                $this->report[] .= "\n\t\tПосада: " . $employee->getPosition() . ", Зарплата: " . $employee->getSalary();
            }
        }
    }

    public function visitDepartment(Department $department) {
        $this->report[] = "\nЗарплатна відомість для департаменту: ";
        foreach ($department->getEmployees() as $employee) {
            $this->report[] .= "\n\tПосада: " . $employee->getPosition() . ", Зарплата: " . $employee->getSalary();
        }
    }

    public function visitEmployee(Employee $employee) {
        $this->report[] = "\nЗарплатна відомість для співробітника: ";
        $this->report[] .= "\n\tПосада: " . $employee->getPosition() . ", Зарплата: " . $employee->getSalary();
    }

    public function getReport() {
        return $this->report;
    }
}

$employee1 = new Employee("Програміст", 5000);
$employee2 = new Employee("Менеджер", 3000);
$department1 = new Department([$employee1, $employee2]);
$department2 = new Department([new Employee("Дизайнер", 4000)]);
$company = new Company([$department1, $department2]);

$reportVisitor = new SalaryReportVisitor();

// Отримати репорт для компанії
$company->accept($reportVisitor);
$companyReport = $reportVisitor->getReport();
echo implode($companyReport);
echo("\n");

$reportVisitor = new SalaryReportVisitor();

//  Отримати репорт для департаменту
$department1->accept($reportVisitor);
$departmentReport = $reportVisitor->getReport();
echo implode($departmentReport);
echo("\n");

$reportVisitor = new SalaryReportVisitor();

//  Отримати репорт для співробітника
$employee1->accept($reportVisitor);
$employeeReport = $reportVisitor->getReport();
echo implode($employeeReport);

?>