<?php


class SectionController{
    public function __construct(private CourseORM $CourseORM, private SectionORM  $SectionORM) {}

    public function sectionCreate(?int $course_id){
        if($course_id === null) header("Location: index.php");
        
        $courseExist = $this->CourseORM->findById($course_id);
        if(!$courseExist) header("Location: index.php");

        $urlArray = explode("/", $_SERVER['HTTP_REFERER']);
        $prevLocation = (end($urlArray));
        

        $titles = $_POST['section-title'];
        $positions = $_POST['section-position'];
        $contents = $_POST['section-content'];

        $good = false;
        $length = min(count($titles), count($contents), count($positions));

        for($i = 0; $i < $length; $i++){
            try{
                $data = ["course_id" => $course_id, "title" => htmlspecialchars($titles[$i]), "content" => htmlspecialchars($contents[$i]), "position" => htmlspecialchars($positions[$i])];
                $good = $this->SectionORM->create($data);
            }catch(PDOException $e){
                if($e->errorInfo[1] === 1062){
                    $courseSections = $this->SectionORM->findByForeignKey($course_id);
                    $lastPosition = end($courseSections)->position;
                    header("Location: {$prevLocation}&last_position=$lastPosition");
                }
            }
        }
        
        if($good) header("Location: index.php?v=coursess&action=detail&course_id=$course_id");
    }

    public function sectionEdit(?int $section_id){

        $section = $this->SectionORM->findById($section_id);
        if(!$section) {
            require_once('./views/error/error.php');
            return;
        }

        $title = $_POST['section-title'][0];
        $content = $_POST['section-content'][0];

        $done = $this->SectionORM->update(["title" => $title, "content" => $content, "id" => $section_id]);
        if($done) header("Location: index.php\?v=courses&action=detail&course_id=$section->courseId");
    }

    public function sectionDelete(?int $section_id){

        if(!isset($section_id)) {
            require_once('./views/error/error.php');
            return;
        }

        $sectionExist = $this->SectionORM->findById($section_id);
        if(empty($sectionExist)){
            require_once('./views/error/error.php');
            return;
        }

        $done = $this->SectionORM->delete($section_id);

        if($done){
            header("location: index.php?v=courses&action=detail&course_id=$sectionExist->courseId");
        }

        require_once('./views/error/error.php');
    }

    public function sectionDetail(?int $section_id){        
        if(!$section_id) header('Location: index.php');
        
        $section = $this->SectionORM->findById($section_id);
        $course = $this->CourseORM->findById($section->courseId);

        require_once('./views/sections/section_detail.php');
    }
    
    public function sectionForm(?int $section_id, ?int $course_id, ?bool $sEditMode){
    
        $positions = [];

        if(is_numeric($course_id)){
            $allSections = $this->SectionORM->findByForeignKey($course_id) ?: [];
            
            foreach($allSections as $s){
                $positions = [...$positions, $s->position];
            };
        }

        $section = null;

        if(is_numeric($section_id)){
            $section = $this->SectionORM->findById($section_id);

            if(empty($section)) {
                require_once('./views/error/error.php');
                return;
            }
            $sEditMode = true;
        }

        require_once('./views/sections/section_form.php');
    }
}