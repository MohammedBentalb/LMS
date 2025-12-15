<?php


class CoursesControlles{
    
    public function __construct(private CourseORM $CourseORM, private SectionORM  $SectionORM) {}

    public  function index(){
        $courses = $this->CourseORM->findAll();
        require_once("../brief-7/views/courses/index.php");
    }

    public function courseForm(?int $course_id, bool $editMode){
        
        $course = null;
        if(is_numeric($course_id)){
            $course = $this->CourseORM->findById($course_id);
            if(empty($course)) {
                require_once('./views/error/error.php');
                return;
            };
            $editMode = true;
        };

        require_once('./views/courses/course_form.php');
    }

    public function courseEdit(?int $course_id, bool $fileError){

        $courseExist = $this->CourseORM->findById($course_id);

        if(!$courseExist){
            require_once('./views/error/error.php');
            return;
        }

        $fileError = false;
        $image = $courseExist->image;
        $MAXMB = 20;
        $allowedTypes = [
            'image/jpeg' => 'jpeg',
            'image/jpg' => 'jpg',
            'image/png' => 'png'
        ];


        if(!empty($_FILES) && $_FILES['course-image']['error'] === 0){
            if(round($_FILES['course-image']['size'] / (1024 * 1024), 2) > $MAXMB || round($_FILES['course-image']['size'] / (1024 * 1024), 2) <= 0 && !key_exists($_FILES['course-image']['type'], $allowedTypes)){
                $fileError = true;
                require_once('./views/courses/course_form.php');
                return;
            } 
            
            $purename =   preg_replace('/[^a-zA-Z0-9]/', '',pathinfo($_FILES['course-image']['full_path'], PATHINFO_FILENAME));
            $image = time() . "-mohammed-2-" . $purename . '.' . $allowedTypes[ $_FILES['course-image']['type']];
            
            if(!is_dir(__DIR__. '/../../public/images')){
                mkdir(__DIR__.'/../../public/images', 777, true);
            };
            move_uploaded_file($_FILES['course-image']['tmp_name'], __DIR__ . "/../../public/images/" . $image);
            unlink(__DIR__ . "/../../public/images/" . $courseExist->image);
        }

        $title = htmlspecialchars($_POST['course-title']);
        $description = htmlspecialchars($_POST['course-content']);
        $level = htmlspecialchars($_POST['course-level']);
        $type = htmlspecialchars($_POST['course-type']);

        $data = ["id" => $course_id, "title" => $title, "description" => $description, "level" => $level, "course_type" => $type, "image" => $image];

        $done = $this->CourseORM->update($data);
        if(!$done){
            require_once('./views/error/error.php');
            return;
        }
        header("location: index.php");
    }
    
    public function courseDetails(?int $course_id){

        $course = $this->CourseORM->findById($course_id);
        $courseSections = $this->SectionORM->findByForeignKey($course_id);

        if(!$course){
            require_once('./views/error/error.php');
            return;
        }
        require_once("./views/courses/course_details.php");
    }
    
    public function courseDelete(?int $course_id){
         
         $courseExist = $this->CourseORM->findById($course_id);
         
         if(!$courseExist){
             require_once('./views/error/error.php');
             return;
            }
            
            unlink('./public/images/' . $courseExist->image);
            $this->CourseORM->delete($course_id);
            header('Location: index.php');
    }

    public function courseCreate(?bool $fileError){

        $MAXMB = 20;
        $fileError = false;
        $allowedTypes = [
            'image/jpeg' => 'jpeg',
            'image/jpg' => 'jpg',
            'image/png' => 'png'
        ];


        if(empty($_FILES['course-image']) || $_FILES['course-image']['error'] != 0 || round($_FILES['course-image']['size'] / (1024 * 1024), 2) > $MAXMB || round($_FILES['course-image']['size'] / (1024 * 1024), 2) <= 0 || !key_exists($_FILES['course-image']['type'], $allowedTypes)){
            $fileError = true;
            require_once('./views/courses/course_form.php');
            return;
        }

        $purename =   preg_replace('/[^a-zA-Z0-9]/', '',pathinfo($_FILES['course-image']['full_path'], PATHINFO_FILENAME));
        $newName = time() . "-mohammed-2-" . $purename . '.' . $allowedTypes[ $_FILES['course-image']['type']];

        if(!is_dir(__DIR__. '/../../public/images')){
            mkdir(__DIR__.'/../../public/images', 777, true);
        };

        $title = htmlspecialchars($_POST['course-title']);
        $description = htmlspecialchars($_POST['course-content']);
        $level = htmlspecialchars($_POST['course-level']);
        $type = htmlspecialchars($_POST['course-type']);

        if(move_uploaded_file($_FILES['course-image']['tmp_name'], __DIR__ . "/../../public/images/" . $newName)){
            $data = ["title" => $title, "description" => $description, "level" => $level, "course_type" => $type, "image" => $newName];
            $done = $this->CourseORM->create($data);
            var_dump($done);
            if($done) header('Location: index.php');
        }

        require_once('./views/error/error.php');
    }
}