<?php
$uri = explode("/",$_SERVER['REQUEST_URI']);

if (count($uri) > 2) {
  // code...
  if (!empty($_GET)) {
    // code...
    $query_string = explode("?",$uri[2])[1];
  } else {
    // code...
    $query_string = "";
  }

  switch ($uri[1]."/".$uri[2]) {
    case 'value':
      // code...
      break;

    default:
      // code...
      break;
  }
} else {
  // code...
  if (!empty($_GET)) {
    // code...
    $query_string = explode("?",$uri[1])[1];
  } else {
    // code...
    $query_string = "";
  }

switch ($uri[1]) {
  case 'dashboard':
    include APP_PATH."/admin/view/dashboard.php";
    break;

  case 'student':
    include APP_PATH."/admin/view/create_student.php";
    break;

  case 'teacher':
    include APP_PATH."/admin/view/create_teacher.php";
    break;

  case 'department':
    include APP_PATH."/admin/view/add_department.php";
    break;

  case 'courses':
    include APP_PATH."/admin/view/add_courses.php";
    break;

  case 'logout':
    include APP_PATH."/admin/view/logout.php";
    break;

  case 'login?'.$query_string:
    include APP_PATH."/admin/view/login.php";
    break;

  case 'signup':
    include APP_PATH."/admin/view/signup.php";
    break;

  case 'editcourse?'.$query_string:
    include APP_PATH."/admin/view/edit_course.php";
    break;

  case 'editcourses':
    include APP_PATH."/admin/view/edit_courses.php";
    break;

  case 'editdepartment?'.$query_string:
    include APP_PATH."/admin/view/edit_department.php";
    break;

  case 'editdepartments':
    include APP_PATH."/admin/view/edit_departments.php";
    break;

  case 'editstudent?'.$query_string:
    include APP_PATH."/admin/view/edit_student.php";
    break;

  case 'editstudents':
    include APP_PATH."/admin/view/edit_students.php";
    break;

  case 'editteacher?' .$query_string:
    include APP_PATH."/admin/view/edit_teacher.php";
    break;

  case 'editteachers':
    include APP_PATH."/admin/view/edit_teachers.php";
    break;


  case 'home':
    // code...
    include APP_PATH."/public/home.php";
    break;

  case 'user_signup':
    // code...
    include APP_PATH."/public/signup.php";
    break;

  case 'user_login?'.$query_string:
    // code...
    include APP_PATH."/public/login.php";
    break;

  case 'userlogout':
      // code...
      include APP_PATH."/public/logout.php";
      break;

  case 'viewcourses':
    // code...
    include APP_PATH."/public/view_courses.php";
    break;

    case 'viewdepartment':
      // code...
      include APP_PATH."/public/view_department.php";
      break;

//    default:
//     include APP_PATH."/view/dashboard.php";
//      break;
}

}
 ?>
