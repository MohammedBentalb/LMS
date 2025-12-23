<?php

namespace controllers\sections;

use Model\Section;
use PDOException;
use Repository\CourseRepository;
use Repository\SectionRepository;

class Controller{
    public function __construct(private CourseRepository $CourseORM, private SectionRepository  $SectionORM) {}

    public function sectionCreate(?int $course_id = null){
        if($course_id === null) header("Location: /");

        $courseExist = $this->CourseORM->findById($course_id);
        if(!$courseExist) header("Location: /");

        $titles = $_POST['section-title'];
        $positions =  $_POST['section-position'];
        $contents = $_POST['section-content'];

        $good = false;
        $length = min(count($titles), count($contents), count($positions));

        for($i = 0; $i < $length; $i++){
            try{
                $data = ["courseId" => $course_id, "title" => $titles[$i], "content" => $contents[$i], "position" => (int) $positions[$i]];
                $section = new Section($data);
                $good = $this->SectionORM->create($section);
                var_dump("i ran");
            }catch(PDOException $e){
                if($e->errorInfo[1] === 1062){
                    $courseSections = $this->SectionORM->findByForeignKey($course_id);
                    $lastPosition = end($courseSections)->position;
                    header("Location: /sections/form/create/$course_id");
                }
            }
        }
        
        if($good) header("Location: /courses/detail/$course_id");
    }

    public function sectionEdit(?int $section_id){
        $sectionExist = $this->SectionORM->findById($section_id);
        if(!$sectionExist) {
            require_once('./views/error/error.php');
            return;
        }
        $title = $_POST['section-title'][0];
        $content = $_POST['section-content'][0];
        $section = new Section(["id" => $sectionExist->id ,"title" => $title, "content" => $content, "courseId" => $sectionExist->courseId, "position" => $sectionExist->position]);
        $done = $this->SectionORM->update($section);
        if($done) header("Location: /courses/detail/$section->courseId");
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
            header("location: /courses/detail/$sectionExist->courseId");
        }

        require_once('./views/error/error.php');
    }

    public function sectionDetail(?int $section_id){        
        if(!$section_id) header('Location: index.php');
        $section = $this->SectionORM->findById($section_id) ?: [];
        $course = $section ? $this->CourseORM->findById($section->courseId) : [];
        require_once('./views/sections/section_detail.php');
    }
    
    public function sectionFormCreate(?int $course_id = null){
        if(!$course_id || !is_numeric($course_id)){
            require_once('./views/error/error.php');
            return;  
        }
        
        $positions = [];
        $sEditMode = false;

        $course = $this->CourseORM->findById($course_id);
        if(!$course){
            require_once('./views/error/error.php');
            return;  
        }
        $sections = $this->SectionORM->findByForeignKey($course_id);

        foreach($sections ?: [] as $s){
            $positions = [...$positions, $s->position];
        }
        $id = $course->id;
        require_once('./views/sections/section_form.php');
    }

    public function sectionFormEdit(?int $section_id = null){
    
        $positions = [];

        if(!$section_id || !is_numeric($section_id)){
            require_once('./views/error/error.php');
            return;
        }

        $section = $this->SectionORM->findById($section_id);
        
        if(!$section){
            require_once('./views/error/error.php');
            return; 
        }
        
        $allCourseSections = $this->SectionORM->findByForeignKey($section->courseId);

        foreach($allCourseSections as $s){
            $positions = [...$positions, $s->position];
        };
        $sEditMode = true;
        $id = $section_id;
        require_once('./views/sections/section_form.php');
    }

    public function sectionAddForm(?int $section_id = null){
    
        $positions = [];

        if(is_numeric($section_id)){
            $allSections = $this->SectionORM->findAll($section_id) ?: [];
            
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