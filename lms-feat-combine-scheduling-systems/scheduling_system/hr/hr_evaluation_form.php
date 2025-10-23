<?php include '../templates/header.php'; ?>
<?php include '../templates/hr_sidebar.php'; ?>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">Employee Evaluation Form</h3>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary mr-2" id="edit-questions-btn">Edit Questions</button>
                                    <button class="btn btn-success" id="save-questions-btn" style="display: none;">Save Questions</button>
                                </div>
                                <form class="forms-sample">
                                    <div class="evaluation-section">
                                        <h4 class="card-title">Mastery of the subject matter:</h4>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Taught without reading notes.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q1" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q1" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q1" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q1" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q1" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Provide examples to illustrate difficult terms or concept.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q2" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q2" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q2" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q2" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q2" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Gave accurate answers to student's questions.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q3" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q3" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q3" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q3" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q3" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Related the topic to real-life situations.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q4" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q4" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q4" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q4" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q4" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Related the subject matter to other fields.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q5" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q5" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q5" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q5" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q5" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>The day's lesson was drawn from the curriculum guide/syllabus.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q6" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q6" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q6" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q6" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q6" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="evaluation-section">
                                        <h4 class="card-title">Communication Skills:</h4>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Used correct grammar in speaking (English or Tagalog).</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q7" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q7" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q7" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q7" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q7" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Maintained eye contact with the students.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q8" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q8" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q8" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q8" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q8" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Considered and used students' ideas and suggestions.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q9" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q9" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q9" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q9" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q9" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Asking probing questions.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q10" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q10" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q10" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q10" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q10" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Spoke in a voice that is clear and loud enough to be heard by everyone.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q11" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q11" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q11" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q11" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q11" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="evaluation-section">
                                        <h4 class="card-title">Classroom Management:</h4>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Seating arrangement was in accordance with the seat plan.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q12" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q12" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q12" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q12" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q12" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Orderliness and cleanliness of the classroom was maintained.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q13" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q13" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q13" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q13" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q13" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Discipline was observed among the students.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q14" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q14" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q14" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q14" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q14" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>Instructional materials were in placed.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q15" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q15" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q15" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q15" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q15" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="evaluation-question">
                                            <textarea class="form-control question-text" rows="2" readonly>The over-all atmosphere of the classroom is conducive to learning.</textarea>
                                            <div class="rating-group">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q16" value="5"> 5</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q16" value="4"> 4</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q16" value="3"> 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q16" value="2"> 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label"><input type="radio" class="form-check-input" name="q16" value="1"> 1</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="evaluation-section">
                                        <h4 class="card-title">Reminder:</h4>
                                        <p>Provide an evaluation for all of your teachers from 1st Semester A.Y. 2025-2026. If you have already completed the evaluation, please skip or do not answer the next evaluation forms.</p>
                                        <h4 class="card-title">Paalala:</h4>
                                        <p>Magbigay ng pagsusuri para sa lahat ng iyong guro mula sa 1st Semester A.Y. 2025-2026. Kung tapos na ang iyong pagsusuri, mangyaring laktawan o huwag sagutan ang mga susunod na form ng pagsusuri.</p>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script>
    document.getElementById('edit-questions-btn').addEventListener('click', function() {
        var textareas = document.querySelectorAll('.question-text');
        textareas.forEach(function(textarea) {
            textarea.readOnly = false;
        });
        document.getElementById('edit-questions-btn').style.display = 'none';
        document.getElementById('save-questions-btn').style.display = 'block';
    });
    document.getElementById('save-questions-btn').addEventListener('click', async function() {
        var textareas = document.querySelectorAll('.question-text');
        var questions = [];
        textareas.forEach(function(textarea, index) {
            questions.push({
                id: index + 1,
                text: textarea.value
            });
            textarea.readOnly = true;
        });
        document.getElementById('edit-questions-btn').style.display = 'block';
        document.getElementById('save-questions-btn').style.display = 'none';

        const formData = new FormData();
        formData.append('action', 'update_evaluation_questions');
        formData.append('questions', JSON.stringify(questions));

        const response = await fetch('../api.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.json();
        if (result.status === 'error') {
            alert(result.message);
        } else {
            alert(result.message);
        }
    });
</script>
<?php include '../templates/footer.php'; ?>
