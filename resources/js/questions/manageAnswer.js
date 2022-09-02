document.getElementById('btnAddAnswer').addEventListener('click', function() {
    const answerList = document.querySelectorAll(this.dataset['element']);
    const lastAnswer = answerList[answerList.length - 1];

    const newAnswer = lastAnswer.cloneNode(true);

    const answerNumberField = newAnswer.querySelector('[data-field-name="answerNumber"]');
    const answerNumberLabel = newAnswer.querySelector('[data-field-label="answerNumber"]');
    let currentAnswerNumberValue = parseInt(answerNumberField.value);
    let newAnswerNumberValue = currentAnswerNumberValue + 1;
    
    answerNumberField.setAttribute('id', `answerNumber${newAnswerNumberValue}`);
    answerNumberField.setAttribute('name', `answers[${currentAnswerNumberValue}][answer_number]`);
    answerNumberField.setAttribute('value', `${newAnswerNumberValue}`);
    answerNumberLabel.setAttribute('for', `answerNumber${newAnswerNumberValue}`);
    
    const answerTextField = newAnswer.querySelector('[data-field-name="answerText"]');
    const answerTextLabel = newAnswer.querySelector('[data-field-label="answerText"]');
    
    answerTextField.setAttribute('id', `answerText${newAnswerNumberValue}`);
    answerTextField.setAttribute('name', `answers[${currentAnswerNumberValue}][answer_text]`);
    answerTextField.setAttribute('value',"");
    answerTextLabel.setAttribute('for', `answerText${newAnswerNumberValue}`);

    lastAnswer.after(newAnswer);
});


document.querySelectorAll('.answerDelete').forEach(function(button) {
    button.addEventListener('click', function(button) {
        deleteAnswer(this);
    });
});


function deleteAnswer(answerDeleteButton) {
    answerDeleteButton.parentNode.parentNode.remove();
    adjustAnswersNumber();
}


function adjustAnswersNumber() {
    const answerList = document.querySelectorAll('.answer');

    answerList.forEach(function(answer, i, answerList) {
        const answerNumber = i + 1;
        
        const answerNumberField = answer.querySelector('[data-field-name="answerNumber"]');
        const answerNumberLabel = answer.querySelector('[data-field-label="answerNumber"]');
        
        answerNumberField.setAttribute('id', `answerNumber${answerNumber}`);
        answerNumberField.setAttribute('name', `answers[${i}][answer_number]`);
        answerNumberField.setAttribute('value', `${answerNumber}`);
        answerNumberLabel.setAttribute('for', `answerNumber${answerNumber}`);
        
        const answerTextField = answer.querySelector('[data-field-name="answerText"]');
        const answerTextLabel = answer.querySelector('[data-field-label="answerText"]');
        
        answerTextField.setAttribute('id', `answerText${answerNumber}`);
        answerTextField.setAttribute('name', `answers[${i}][answer_text]`);
        answerTextLabel.setAttribute('for', `answerText${answerNumber}`);
    });
}