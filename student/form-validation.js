document.addEventListener('DOMContentLoaded', () => {

    const gradePoints = {
        'A': 8,
        'B': 7,
        'C': 6,
        'D': 5,
        'E': 4,
        'F': 1,
        'U': 0,
        'AA': 16,  // Double A
        'BB': 14,  // Double B
        'CC': 12,  // Double C
        'DD': 10,  // Double D
        'EE': 8,   // Double E
        'FF': 2,   // Double F
        'UU': 0    // Double U
    };

    // Points storage
    let corePoints = 0;
    let sciencePoints = 0;
    let totalPoints = 0;

    // ... (your existing variable declarations and event listeners remain the same)

    function calculatePoints() {
        corePoints = 0;
        sciencePoints = 0;
        totalPoints = 0;
    
        // Core subjects (all except sciences)
        const coreSubjects = [
            'mathsGrade', 'englishGrade', 'SetswanaGrade', 'CommerceGrade',
            'SocialStudiesGrade', 'AgricultureGrade', 'AccountingGrade',
            'ReligiousEducationGrade', 'AdditionalMathsGrade', 'GeologyGrade',
            'DevelopmentStudiesGrade', 'ComputerStudiesGrade'
        ];
    
        // Calculate science points and determine spots
        const scienceType = sciencesSelect.value;
        let scienceEntries = [];
        let scienceSpotCount = 0;
    
        if (scienceType === 'double') {
            const doubleGrade = document.getElementById('scienceDoubleGrade')?.value;
            if (doubleGrade) {
                sciencePoints = gradePoints[doubleGrade] || 0;
                scienceEntries.push(sciencePoints);
                scienceSpotCount = 2;
            }
        } else {
            ['biologyGrade', 'physicsGrade', 'chemistryGrade'].forEach(subjectId => {
                const grade = document.getElementById(subjectId)?.value;
                if (grade) {
                    const points = gradePoints[grade] || 0;
                    sciencePoints += points;
                    scienceEntries.push(points);
                }
            });
            scienceSpotCount = 3;
        }
    
        // Calculate core points (for all core subjects)
        const coreEntries = [];
        coreSubjects.forEach(subjectId => {
            const grade = document.getElementById(subjectId)?.value;
            if (grade) {
                const points = gradePoints[grade] || 0;
                corePoints += points; // Original core points total
                coreEntries.push(points);
            }
        });
    
        // Calculate best six points
        const availableCoreSpots = 6 - scienceSpotCount;
        const sortedCore = [...coreEntries].sort((a, b) => b - a);
        const bestCore = sortedCore.slice(0, availableCoreSpots);
        
        const calculatedTotal = [...scienceEntries, ...bestCore].reduce((a, b) => a + b, 0);
        totalPoints = Math.min(calculatedTotal, 48); // Enforce 48-point cap
    
        // Preserve original sciencePoints value for other uses
        sciencePoints = scienceEntries.reduce((a, b) => a + b, 0);
    }

    // Modified handleFormSubmit to send to PHP
    async function handleFormSubmit(e) {
        e.preventDefault();
        
        // Validate all steps
        if (![1,2,3,4].every(step => validateStep(step))) {
            alert('Please correct form errors before submitting.');
            return;
        }
        
        // Calculate points
        calculatePoints();
        
        // Create FormData object from form
        const formData = new FormData(form);
        
        // Add calculated points to form data
        formData.append('core_points', corePoints);
        formData.append('science_points', sciencePoints);
        formData.append('total_points', totalPoints);
        
        try {
            // Send data to PHP
            const response = await fetch('process_application.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.text();
            
            if (response.ok) {
                alert('Application submitted successfully!\nTotal Points: ' + totalPoints + '\nServer response: ' + result);
                form.reset();
                showStep(1);
            } else {
                throw new Error(result || 'Server error');
            }
        } catch (error) {
            console.error('Submission error:', error);
            alert('Submission failed: ' + error.message);
        }
    }

            let currentStep = 1;
            const courses = {
                engineering: ['Civil Engineering', 'Mechanical Engineering', 'Electrical Engineering'],
                business: ['Business Management', 'Accounting', 'Marketing'],
                science: ['Computer Science', 'Biology', 'Chemistry', 'Physics']
            };

            const form = document.getElementById('applicationForm');
            const facultySelect = document.getElementById('faculty');
            const courseSelect = document.getElementById('course');
            const sciencesSelect = document.getElementById('sciences');

            facultySelect.addEventListener('change', updateCourses);
            sciencesSelect.addEventListener('change', updateScienceGrades);
            document.querySelectorAll('[data-action]').forEach(btn => {
                btn.addEventListener('click', e => {
                    const action = e.target.dataset.action;
                    if (action === 'next') nextStep();
                    if (action === 'prev') prevStep();
                });
            });
            form.addEventListener('submit', handleFormSubmit);

            function updateCourses() {
                const faculty = facultySelect.value;
                courseSelect.innerHTML = '<option value="">Select Course</option>';
                if (faculty) {
                    courseSelect.disabled = false;
                    courses[faculty].forEach(c => {
                        courseSelect.innerHTML += `<option value="${c}">${c}</option>`;
                    });
                } else {
                    courseSelect.disabled = true;
                    courseSelect.innerHTML = '<option value="">First select a faculty</option>';
                }
            }

            function updateScienceGrades() {
                const type = sciencesSelect.value;
                document.getElementById('double-award-grades').style.display = type === 'double' ? 'block' : 'none';
                document.getElementById('pure-science-grades').style.display = type === 'pure' ? 'block' : 'none';
            }

            function showStep(step) {
                document.querySelectorAll('.form-step').forEach(el => el.classList.remove('active'));
                document.getElementById(`step${step}`).classList.add('active');
                currentStep = step;
                if (step === 3) updateScienceGrades();
            }

            function nextStep() {
                if (validateStep(currentStep) && currentStep < 4) showStep(currentStep + 1);
            }
            function prevStep() {
                if (currentStep > 1) showStep(currentStep - 1);
            }

            function validateStep(step) {
                let valid = true;
                const stepEl = document.getElementById(`step${step}`);
                stepEl.querySelectorAll('.error-message').forEach(el => el.textContent = '');
                stepEl.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                if (step === 1) {
                    ['fullName','ID'].forEach(id => {
                        const inp = document.getElementById(id);
                        if (!inp.value.trim()) { showError(inp, 'This field is required'); valid = false; }
                    });
                }
                if (step === 2) {
                    if (!facultySelect.value) { showError(facultySelect, 'Please select a faculty'); valid = false; }
                    if (!courseSelect.value)  { showError(courseSelect,  'Please select a course');  valid = false; }
                }
                if (step === 3) {
                    const grades = getGradeValues();
                    if (!sciencesSelect.value) { showError(sciencesSelect, 'Please select science option'); valid = false; }
                    if (!grades.maths) { showError(document.getElementById('mathsGrade'), 'Maths grade required'); valid = false; }
                    if (!grades.english) { showError(document.getElementById('englishGrade'), 'English grade required'); valid = false; }
                    if (valid) {
                        const fac = facultySelect.value;
                        if (fac === 'engineering') valid = validateEngineering(grades);
                        else if (fac === 'business') valid = validateBusiness(grades);
                        else if (fac === 'science') valid = validateScience(grades);

                        
                    }
                }
                return valid;
            }

            function getGradeValues() {
                return {
                    scienceDouble: document.getElementById('scienceDoubleGrade')?.value,
                    biology: document.getElementById('biologyGrade')?.value,
                    physics: document.getElementById('physicsGrade')?.value,
                    chemistry: document.getElementById('chemistryGrade')?.value,
                    maths: document.getElementById('mathsGrade').value,
                    english: document.getElementById('englishGrade').value
                };
            }

            function showError(input, msg) {
                input.classList.add('is-invalid');
                const err = document.getElementById(`${input.id}Error`);
                if (err) err.textContent = msg;
            }

            function validateEngineering(grades) {
                let ok = true;
                const order = ['A','B','C','D','E','F','U'];
                const daOrder = ['AA','BB','CC','DD','EE','FF','UU'];
                if (sciencesSelect.value === 'double') {
                    if (daOrder.indexOf(grades.scienceDouble) > daOrder.indexOf('BB')) {
                        showError(document.getElementById('scienceDoubleGrade'), 'Minimum BB required for Engineering'); ok = false;
                    }
                } else {
                    ['biology','physics','chemistry'].forEach(sub => {
                        if (order.indexOf(grades[sub]) > order.indexOf('B')) {
                            showError(document.getElementById(`${sub}Grade`), `Minimum B required in ${sub}`); ok = false;
                        }
                    });
                }
                if (order.indexOf(grades.maths) > order.indexOf('B'))   { showError(document.getElementById('mathsGrade'),   'Minimum B in Maths required');   ok = false; }
                if (order.indexOf(grades.english) > order.indexOf('D')) { showError(document.getElementById('englishGrade'), 'Minimum D in English required'); ok = false; }
                return ok;
            }
            function validateBusiness(grades) {
    let valid = true;
    const gradeOrder = ['A', 'B', 'C', 'D', 'E', 'F', 'U'];
    const daOrder = ['AA', 'BB', 'CC', 'DD', 'EE', 'FF', 'UU'];

    // Science validation
    if (sciencesSelect.value === 'double') {
        if (daOrder.indexOf(grades.scienceDouble) > daOrder.indexOf('CC')) {
            showError(document.getElementById('scienceDoubleGrade'), 'Minimum CC required for Business');
            valid = false;
        }
    } else {
        ['biology', 'physics', 'chemistry'].forEach(sub => {
            if (gradeOrder.indexOf(grades[sub]) > gradeOrder.indexOf('C')) {
                showError(document.getElementById(`${sub}Grade`), `Minimum C required in ${sub}`);
                valid = false;
            }
        });
    }

    // Maths validation
    if (gradeOrder.indexOf(grades.maths) > gradeOrder.indexOf('C')) {
        showError(document.getElementById('mathsGrade'), 'Minimum C in Maths required');
        valid = false;
    }

    // English validation
    if (gradeOrder.indexOf(grades.english) > gradeOrder.indexOf('B')) {
        showError(document.getElementById('englishGrade'), 'Minimum B in English required');
        valid = false;
    }

    return valid;
}

function validateScience(grades) {
    let valid = true;
    const gradeOrder = ['A', 'B', 'C', 'D', 'E', 'F', 'U'];
    const daOrder = ['AA', 'BB', 'CC', 'DD', 'EE', 'FF', 'UU'];

    // Science validation
    if (sciencesSelect.value === 'double') {
        if (daOrder.indexOf(grades.scienceDouble) > daOrder.indexOf('CC')) {
            showError(document.getElementById('scienceDoubleGrade'), 'Minimum CC required for Science');
            valid = false;
        }
    } else {
        ['biology', 'physics', 'chemistry'].forEach(sub => {
            if (gradeOrder.indexOf(grades[sub]) > gradeOrder.indexOf('C')) {
                showError(document.getElementById(`${sub}Grade`), `Minimum C required in ${sub}`);
                valid = false;
            }
        });
    }

    // Maths validation
    if (gradeOrder.indexOf(grades.maths) > gradeOrder.indexOf('C')) {
        showError(document.getElementById('mathsGrade'), 'Minimum C in Maths required');
        valid = false;
    }

    // English validation
    if (gradeOrder.indexOf(grades.english) > gradeOrder.indexOf('D')) {
        showError(document.getElementById('englishGrade'), 'Minimum D in English required');
        valid = false;
    }

    return valid;
}

            function handleFormSubmit(e) {
                e.preventDefault();
                if ([1,2,3,4].every(s => validateStep(s))) {
                    alert('Application submitted successfully!');
                    form.reset(); showStep(1);
                } else {
                    alert('Please correct form errors before submitting.');
                }
            }

            // Initial
            updateCourses(); showStep(1);
            function calculateBestSix() {
                // Get all grades from the form
                const allGrades = [];
                
                // Core subjects (all except sciences)
                const coreSubjects = [
                    'mathsGrade', 'englishGrade', 'SetswanaGrade', 'CommerceGrade',
                    'SocialStudiesGrade', 'AgricultureGrade', 'AccountingGrade',
                    'ReligiousEducationGrade', 'AdditionalMathsGrade', 'GeologyGrade',
                    'DevelopmentStudiesGrade', 'ComputerStudiesGrade'
                ];
                
                // Add core subject grades
                coreSubjects.forEach(subjectId => {
                    const grade = document.getElementById(subjectId)?.value;
                    if (grade) {
                        allGrades.push({
                            subject: subjectId.replace('Grade', ''),
                            grade: grade,
                            points: gradePoints[grade] || 0
                        });
                    }
                });
                
                // Add science grades based on type
                const scienceType = sciencesSelect.value;
                if (scienceType === 'double') {
                    const doubleGrade = document.getElementById('scienceDoubleGrade')?.value;
                    if (doubleGrade) {
                        allGrades.push({
                            subject: 'ScienceDouble',
                            grade: doubleGrade,
                            points: gradePoints[doubleGrade] || 0
                        });
                    }
                } else {
                    ['biologyGrade', 'physicsGrade', 'chemistryGrade'].forEach(subjectId => {
                        const grade = document.getElementById(subjectId)?.value;
                        if (grade) {
                            allGrades.push({
                                subject: subjectId.replace('Grade', ''),
                                grade: grade,
                                points: gradePoints[grade] || 0
                            });
                        }
                    });
                }
                
                // Sort by points (descending) and take top 6
                const sortedGrades = allGrades.sort((a, b) => b.points - a.points);
                const bestSix = sortedGrades.slice(0, 6);
                
                // Calculate total points for best 6
                const bestSixTotal = bestSix.reduce((sum, subject) => sum + subject.points, 0);
                
                return {
                    subjects: bestSix,
                    totalPoints: bestSixTotal
                };
            }
              // 1) Attach your handler
  form.addEventListener("submit", handleFormSubmit);

            
            // Modified handleFormSubmit to include best six
            async function handleFormSubmit(e) {
                e.preventDefault(); // Prevent default form submission
                
                // Validate all steps first
                if (![1, 2, 3, 4].every(step => validateStep(step))) {
                    alert('Please correct form errors before submitting.');
                    return;
                }
            
                // Calculate points
                calculatePoints();
                const bestSix = calculateBestSix();
            
                // Create FormData and append points
                const formData = new FormData(document.getElementById('applicationForm'));
                formData.append('core_points', corePoints);
                formData.append('science_points', sciencePoints);
                formData.append('total_points', totalPoints);
                formData.append('best_six_points', bestSix.totalPoints);
                formData.append('best_six_subjects', JSON.stringify(bestSix.subjects));
            
                try {
                    // Send data via POST
                    
                    const response = await fetch('process_application.php', {
                        method: 'POST',
                        body: formData
                    });
            
                    // Handle response
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    
                    // Get the HTML response
                    const resultHtml = await response.text();
            
                    // Display in new tab
                    const newWindow = window.open('', '_blank');
                    newWindow.document.write(resultHtml);
                    newWindow.document.close();
            
                } catch (error) {
                    console.error('Submission error:', error);
                    alert('Submission failed: ' + error.message);
                }
            }
        });
    