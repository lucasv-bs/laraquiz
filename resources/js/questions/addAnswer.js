document.getElementById('btnAddAnswer').addEventListener('click', function() {
    const firstAnswer = document.querySelectorAll(this.dataset['element'])[0];

    const newAnswer = firstAnswer.cloneNode(true);

    const answerNumberField = newAnswer.querySelector('[data-field-name="answerNumber"]');
    const answerNumberLabel = newAnswer.querySelector('[data-field-label="answerNumber"]');
    let currentAnswerNumberValue = parseInt(answerNumberField.value);
    let newAnswerNumberValue = currentAnswerNumberValue + 1;
    
    answerNumberField.setAttribute('id', `answerNumber${newAnswerNumberValue}`);
    answerNumberField.setAttribute('name', `answers[${currentAnswerNumberValue}][answer_number]`);
    answerNumberField.setAttribute('value', `${newAnswerNumberValue}`);
    answerNumberLabel.setAttribute('for', `answerNumber${newAnswerNumberValue}`);
    
    console.log(answerNumberField);

    const answerTextField = newAnswer.querySelector('[data-field-name="answerText"]');
    const answerTextLabel = newAnswer.querySelector('[data-field-label="answerText"]');

    
    answerTextField.setAttribute('id', `answerText${newAnswerNumberValue}`);
    answerTextField.setAttribute('name', `answers[${currentAnswerNumberValue}][answer_text]`);
    answerTextField.setAttribute('value',"");
    answerTextLabel.setAttribute('for', `answerText${newAnswerNumberValue}`);

    firstAnswer.before(newAnswer);
});