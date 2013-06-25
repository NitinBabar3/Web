<?php

class Question {
    public $ID;
    public $QuestionText;
    public $SubCategoryId;
    public $QuestionType;
    public $CreatedByUserId;
    public $CreatedOn;
    public $Deleted;
}



class QuestionOption {
    
    public $ID;
    public $QuestionId;
    public $OptionText;
    public $IsCorrect;
    public $Deleted;
        
}

?>