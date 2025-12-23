<?php

namespace Controllers\Dashboard;

use Repository\StatisticsRepository;

class Controller{
    public function __construct(private StatisticsRepository $StatisticsRepo) {
    }


    public function index(){
        $totalUsers = $this->StatisticsRepo->getTotalUsers();
        $totalcourses = $this->StatisticsRepo->getTotalCourses();
        $averageSectionPerCourse = $this->StatisticsRepo->getAverageSectionPerCourse();
        $courseAndNumberOfEnrollments = $this->StatisticsRepo->getcoursesAnNumberOfEnrollments();
        $popularCourse = $this->StatisticsRepo->getMostPopularCourse();
        $coursesWithMoreSections = $this->StatisticsRepo->getCoursesWithMoreThan5Sections();
        $lastCourseEnrolledAt = $this->StatisticsRepo->getLastCourseEnrolledAt();
        $usersWithNoInsriptions = $this->StatisticsRepo->getUsersWithNoInscriptions();
        require_once("./views/dashboard/dashboard.php");
    }
}