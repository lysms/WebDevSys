<?php
  class Person {
    private $fname;
    private $lname;
    public function __construct($fn, $ln) {
      $this->fname = $fn;
      $this->lname = $ln;
    }
  }

  class Student extends Person {
      private $rin;
      public function __construct($fn, $ln, $r) {
      // call the parent constructor
      parent::__construct($fn, $ln);
      $this->rin = $r;
      }
  }

  class RPIStudent extends Student {
    private $courses;
    public function __construct($fn, $ln, $r, $c) {
      // call the parent constructor
      parent::__construct($fn, $ln, $r);
      $this->courses = $c;
    }
    // tested this in xammp^^  working yea posted in slack? NIce
    public function getCourses(){
      return $this->courses;
    }    
  }
  $student = new RPIStudent("john", "stevens", "11122233", ["Intro to ITWS", "Data Structures", "IT and Society"]);
  $courses = $student -> getCourses();
  foreach($courses as $course){
    echo $course . "\n";
  }
?>
