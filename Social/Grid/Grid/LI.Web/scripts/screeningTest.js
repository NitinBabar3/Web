var objScreeningTest;
var getTestDetailsURL = "http://localhost:8081/letsintern/iteration1/root/LI.Services/getTestDetails.php?testId=";
var testId=1;
var currentQuestionIndex = 0;
var currentQuestion;
var totalTestTime;
var timer;
var totalQNo;
var questionSet;
    
function startTest(id){
    
    
   testId=id;
    
    // First bind UI elements to Events
        $('#nxtQuestion').click(NextQuestion);
        $('#prvQuestion').click(PreviousQuestion);
        
    
    // Prepare Varialbles
    
    
   
    
    getTestDetails();
    
        
    
    // Timer Code starts
    
    
    startTimer(totalTestTime);

    
    
    

    function startTimer(totalTestTime) {
        if (timer) clearInterval(timer);
       // totalTestTime = 10;
        timer = setInterval(function () {
            $('#timerSec').text(totalTestTime-- + " seconds remaining");
            if (totalTestTime == -1) {
                clearInterval(timer); // On Timer Elapse , END TEST
            }
        }, 1000);
    }

    

    function getTestDetails() {

        // Get Test Details - name , Subject , Time ,  Description etc.

      
        $.ajax({
            type: "GET",
            url: getTestDetailsURL + testId,
            data: "",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: OnGetTestDataSuccess,
            error: OnGetDataError
        });

    }

    function OnGetTestDataSuccess(data) {
        
        
        objScreeningTest = data;        
        DisplayTestDetails();
        startTimer(totalTestTime); // Get Test Details Data


    }
    function OnGetDataError(){};
    function DisplayTestDetails() { 

    $('#testDetails #testName').text(objScreeningTest.TestTitle);
    //$('#testDetails #testDescription').text(testDetails.description);
    //$('#testDetails #testCredits').text(testDetails.credit);
    totalTestTime = objScreeningTest.Duration;
    questionSet = objScreeningTest.Questions;
    DisplayQuestion(0);
    //totalQNo = testDetails.noOfQuestions;


    }

    function DisplayQuestion(i) {
        
        currentQuestion= questionSet[i];
        $("#questionDisplay").html(currentQuestion.QuestionText);
        $("#optionA input:radio").val(currentQuestion.Options[0].ID);
        $("#optionB input:radio").val(currentQuestion.Options[1].ID);
        $("#optionC input:radio").val(currentQuestion.Options[2].ID);
        $("#optionD input:radio").val(currentQuestion.Options[3].ID);

        $("#optionAText").html(currentQuestion.Options[0].OptionText);
        $("#optionBText").html(currentQuestion.Options[1].OptionText);
        $("#optionCText").html(currentQuestion.Options[2].OptionText);
        $("#optionDText").html(currentQuestion.Options[3].OptionText);      
        
        

        

    }

    function NextQuestion() {
    
        questionSet[currentQuestionIndex].answer = $('input:radio[name=rbOptions]:checked').val();
        currentQuestionIndex = currentQuestionIndex + 1;
        DisplayQuestion(currentQuestionIndex);

        if (currentQuestionIndex == (questionSet.length - 1)) {

            $('#nxtQuestion').attr("disabled", true);
            $('#prvQuestion').attr("disabled", false);
        }

        else {
            $('#nxtQuestion').attr("disabled", false);
            $('#prvQuestion').attr("disabled", false);
        }

      
    }

    function PreviousQuestion() {
    
        questionSet[currentQuestionIndex].answer = $('input:radio[name=rbOptions]:checked').val();
        currentQuestionIndex = currentQuestionIndex - 1;
        DisplayQuestion(currentQuestionIndex);

        if (currentQuestionIndex == 0) {

            $('#prvQuestion').attr("disabled", true);
            $('#nxtQuestion').attr("disabled", false);

        }

        else {

            $('#prvQuestion').attr("disabled", false);
            $('#nxtQuestion').attr("disabled", false);

        }


    }

}
