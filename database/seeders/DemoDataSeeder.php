<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Department
        $department = Department::create([
            'name' => 'BCA',
            'code' => 'BCA'
        ]);

        // Create Semesters
        $semesters = [];
        for ($i = 1; $i <= 6; $i++) {
            $semesters[] = Semester::create([
                'name' => "Semester {$i}",
                'start_date' => now()->addMonths(($i - 1) * 6)->startOfMonth(),
                'end_date' => now()->addMonths($i * 6)->endOfMonth(),
            ]);
        }

        // Create Subjects
        $subjectsData = [
            // Semester 1
            ['name' => 'English Communication', 'code' => 'ENG101', 'credits' => 3, 'semester_id' => $semesters[0]->id],
            ['name' => 'Mathematics I', 'code' => 'MATH101', 'credits' => 4, 'semester_id' => $semesters[0]->id],

            // Semester 2
            ['name' => 'Business Communication', 'code' => 'BUS102', 'credits' => 3, 'semester_id' => $semesters[1]->id],
            ['name' => 'Mathematics II', 'code' => 'MATH102', 'credits' => 4, 'semester_id' => $semesters[1]->id],

            // Semester 3
            ['name' => 'Data Structures', 'code' => 'CS201', 'credits' => 4, 'semester_id' => $semesters[2]->id],
            ['name' => 'Database Management', 'code' => 'DBMS201', 'credits' => 4, 'semester_id' => $semesters[2]->id],

            // Semester 4
            ['name' => 'Web Development', 'code' => 'WEB202', 'credits' => 4, 'semester_id' => $semesters[3]->id],
            ['name' => 'Software Engineering', 'code' => 'SE202', 'credits' => 3, 'semester_id' => $semesters[3]->id],

            // Semester 5
            ['name' => 'Mobile App Development', 'code' => 'MAD301', 'credits' => 4, 'semester_id' => $semesters[4]->id],
            ['name' => 'Cloud Computing', 'code' => 'CC301', 'credits' => 3, 'semester_id' => $semesters[4]->id],

            // Semester 6
            ['name' => 'Project Management', 'code' => 'PM302', 'credits' => 3, 'semester_id' => $semesters[5]->id],
            ['name' => 'Final Year Project', 'code' => 'FYP302', 'credits' => 6, 'semester_id' => $semesters[5]->id],
        ];

        $subjects = [];
        foreach ($subjectsData as $subjectData) {
            $subjects[] = Subject::create(array_merge($subjectData, ['department_id' => $department->id]));
        }

        // Create Teachers
        $teachersData = [
            [
                'name' => 'Dr. Rajesh Kumar',
                'email' => 'rajesh.kumar@college.edu',
                'employee_id' => 'T001',
            ],
            [
                'name' => 'Prof. Priya Sharma',
                'email' => 'priya.sharma@college.edu',
                'employee_id' => 'T002',
            ],
        ];

        $teachers = [];
        foreach ($teachersData as $teacherData) {
            $user = User::create([
                'name' => $teacherData['name'],
                'email' => $teacherData['email'],
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('Teacher');

            $teacher = Teacher::create([
                'user_id' => $user->id,
                'employee_id' => $teacherData['employee_id'],
                'department_id' => $department->id,
            ]);

            $teachers[] = $teacher;
        }

        // Assign subjects to teachers
        $teachers[0]->subjects()->attach([$subjects[0]->id, $subjects[2]->id, $subjects[4]->id, $subjects[6]->id, $subjects[8]->id]); // Rajesh teaches odd-indexed subjects
        $teachers[1]->subjects()->attach([$subjects[1]->id, $subjects[3]->id, $subjects[5]->id, $subjects[7]->id, $subjects[9]->id]); // Priya teaches even-indexed subjects

        // Create Students
        $studentsData = [
            [
                'name' => 'Amit Singh',
                'email' => 'amit.singh@student.edu',
                'enrollment_no' => 'BCA2024001',
                'semester_id' => $semesters[5]->id, // Semester 6
            ],
            [
                'name' => 'Sneha Patel',
                'email' => 'sneha.patel@student.edu',
                'enrollment_no' => 'BCA2024002',
                'semester_id' => $semesters[5]->id, // Semester 6
            ],
            [
                'name' => 'Rahul Verma',
                'email' => 'rahul.verma@student.edu',
                'enrollment_no' => 'BCA2024003',
                'semester_id' => $semesters[4]->id, // Semester 5
            ],
            [
                'name' => 'Kavita Joshi',
                'email' => 'kavita.joshi@student.edu',
                'enrollment_no' => 'BCA2024004',
                'semester_id' => $semesters[4]->id, // Semester 5
            ],
            [
                'name' => 'Vikram Rao',
                'email' => 'vikram.rao@student.edu',
                'enrollment_no' => 'BCA2024005',
                'semester_id' => $semesters[3]->id, // Semester 4
            ],
        ];

        $students = [];
        foreach ($studentsData as $studentData) {
            $user = User::create([
                'name' => $studentData['name'],
                'email' => $studentData['email'],
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('Student');

            $student = Student::create([
                'user_id' => $user->id,
                'enrollment_no' => $studentData['enrollment_no'],
                'department_id' => $department->id,
                'semester_id' => $studentData['semester_id'],
            ]);

            $students[] = $student;
        }

        // Create Exam
        $exam = Exam::create([
            'name' => 'Board',
            'type' => 'university',
            'semester_id' => $semesters[5]->id, // Final semester exam
            'start_date' => now()->addDays(30),
            'end_date' => now()->addDays(45),
        ]);

        // Create some sample results for demonstration
        $exam->results()->createMany([
            [
                'student_id' => $students[0]->id,
                'subject_id' => $subjects[8]->id, // Mobile App Development
                'semester_id' => $semesters[4]->id, // Semester 5
                'internal_marks' => 85,
                'external_marks' => 78,
                'total_marks' => 163,
                'grade' => 'A',
            ],
            [
                'student_id' => $students[0]->id,
                'subject_id' => $subjects[9]->id, // Cloud Computing
                'semester_id' => $semesters[4]->id, // Semester 5
                'internal_marks' => 82,
                'external_marks' => 75,
                'total_marks' => 157,
                'grade' => 'A',
            ],
            [
                'student_id' => $students[1]->id,
                'subject_id' => $subjects[8]->id, // Mobile App Development
                'semester_id' => $semesters[4]->id, // Semester 5
                'internal_marks' => 78,
                'external_marks' => 82,
                'total_marks' => 160,
                'grade' => 'A',
            ],
        ]);

        // Create a sample notice
        \App\Models\Notice::create([
            'title' => 'Final Semester Examination Schedule',
            'content' => 'The final semester examinations will begin on ' . now()->addDays(30)->format('M d, Y') . '. All students are required to check their exam schedules and prepare accordingly. Best of luck!',
            'target' => 'all',
        ]);

        $this->command->info('Demo data seeded successfully!');
        $this->command->info('Admin login: admin@example.com / password');
        $this->command->info('Teacher logins: rajesh.kumar@college.edu / priya.sharma@college.edu / password');
        $this->command->info('Student logins: amit.singh@student.edu, sneha.patel@student.edu, etc. / password');
    }
}
