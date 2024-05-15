<?php

namespace App\Http\Controllers\Google\Workspace\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Google\GoogleApiAuth;
use Google\Client;
use Google\Exception;
use Google\Service\Classroom;
use Google\Service\Classroom\Course;
use Google\Service\Classroom\Student;
use Google\Service\Classroom\Teacher;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function listCourses($email = 'it@srcspatna.com')
    {
        /* Load pre-authorized user credentials from the environment.
    TODO (developer) - See https://developers.google.com/identity for
     guides on implementing OAuth2 for your application. */
        $client = new Client();

        // $client->useApplicationDefaultCredentials();
        $client->setAuthConfig(env('GOOGLE_APPLICATION_CREDENTIALS'));

        $client->setSubject($email);

        $client->addScope('https://www.googleapis.com/auth/classroom.courses');

        $service = new Classroom($client);

        $courses = [];

        $pageToken = '';



        do {

            $params = [

                'pageSize' => 5,

                'pageToken' => $pageToken,

            ];

            $response = $service->courses->listCourses($params);

            $courses = array_merge($courses, $response->courses);

            $pageToken = $response->nextPageToken;
        } while (!empty($pageToken));

        return view('google.workspace.classroom.listCourses')->with(['status' => 'info', 'message' => 'Message', 'courses' => $courses]);
    }

    public function createCourse(Request $request, $email = 'it@srcspatna.com')
    {
        // if (! auth()->user()->can('classroom_course_create')) {
        //     return abort(403, "You don't have permission!");
        // }

        // Validate request
        $request->validate([
            'class_name' => 'required',
            'section' => 'nullable',
            'subject' => 'nullable',
            'room' => 'nullable',
        ]);

        $client = new Client();
        $client->useApplicationDefaultCredentials();
        $client->setSubject($email);
        $client->addScope('https://www.googleapis.com/auth/classroom.courses');
        $service = new Classroom($client);
        try {
            $course = new Course([
                'name' => $request->class_name,
                'section' => $request->class_name,
                'descriptionHeading' => 'Welcome to ' . $request->class_name,
                'description' => $request->subject,
                'room' => $request->room,
                'ownerId' => 'me',
                'courseState' => 'PROVISIONED',
            ]);
            $course = $service->courses->create($course);

            return redirect()->route('google.workspace.classroom.listCourses')->with(['status' => 'info', 'message' => 'Message']);
        } catch (Exception $e) {
            return 'Message: ' . $e->getMessage();
        }
    }

    public function getCourse($courseId, $email = 'it@srcspatna.com')
    {
        /* Load pre-authorized user credentials from the environment.
    TODO (developer) - See https://developers.google.com/identity for
     guides on implementing OAuth2 for your application. */
        $client = new Client();
        $client->useApplicationDefaultCredentials();
        $client->setSubject($email);
        $client->addScope('https://www.googleapis.com/auth/classroom.courses');
        $service = new Classroom($client);
        try {
            $course = $service->courses->get($courseId);

            return view('google.workspace.classroom.course')->with(['course' => $course]);
        } catch (Exception $e) {
            if ($e->getCode() == 404) {
                printf("Course with ID '%s' not found.\n", $courseId);
            } else {
                throw $e;
            }
        }
    }

    public function deleteCourse($courseId, $email = 'it@srcspatna.com')
    {
        /* Load pre-authorized user credentials from the environment.
    TODO (developer) - See https://developers.google.com/identity for
     guides on implementing OAuth2 for your application. */
        $client = new Client();
        $client->useApplicationDefaultCredentials();
        $client->setSubject($email);
        $client->addScope('https://www.googleapis.com/auth/classroom.courses');
        $service = new Classroom($client);
        try {
            $course = $service->courses->delete($courseId);

            return redirect()->route('google.workspace.classroom.listCourses');
        } catch (Exception $e) {
            if ($e->getCode() == 404) {
                abort(403, 'Course Not Found!');
            } else {
                throw $e;
            }
        }
    }

    public function addTeacher($courseId, $teacherEmail, $email = 'it@srcspatna.com')
    {
        /* Load pre-authorized user credentials from the environment.
    TODO (developer) - See https://developers.google.com/identity for
     guides on implementing OAuth2 for your application. */
        $client = new Client();
        $client->useApplicationDefaultCredentials();
        $client->setSubject($email);
        $client->addScope('https://www.googleapis.com/auth/classroom.profile.photos');
        $service = new Classroom($client);
        $teacher = new Teacher([
            'userId' => $teacherEmail,
        ]);
        try {
            //  calling create teacher
            $teacher = $service->courses_teachers->create($courseId, $teacher);
            printf(
                "User '%s' was added as a teacher to the course with ID '%s'.\n",
                $teacher->profile->name->fullName,
                $courseId
            );
        } catch (Exception $e) {
            if ($e->getCode() == 409) {
                printf("User '%s' is already a member of this course.\n", $teacherEmail);
            } else {
                throw $e;
            }
        }

        return $teacher;
    }

    public function enrollAsStudent($courseId, $enrollmentCode, $email = 'it@srcspatna.com')
    {
        /* Load pre-authorized user credentials from the environment.
    TODO (developer) - See https://developers.google.com/identity for
     guides on implementing OAuth2 for your application. */
        $client = new Client();
        $client->useApplicationDefaultCredentials();
        $client->setSubject($email);
        $client->addScope('https://www.googleapis.com/auth/classroom.profile.emails');
        $service = new Classroom($client);
        $student = new Student([
            'userId' => 'me',
        ]);
        $params = [
            'enrollmentCode' => $enrollmentCode,
        ];
        try {
            $student = $service->courses_students->create($courseId, $student, $params);
            printf(
                "User '%s' was enrolled  as a student in the course with ID '%s'.\n",
                $student->profile->name->fullName,
                $courseId
            );
        } catch (Exception $e) {
            if ($e->getCode() == 409) {
                echo "You are already a member of this course.\n";
            } else {
                throw $e;
            }
        }

        return $student;
    }
}
