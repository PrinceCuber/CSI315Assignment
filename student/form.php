<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Application Form</title>
    <link rel="stylesheet" href="formCSS.css">

    
    <script src="form-validation.js" defer></script>
</head>
<body>
    <div class="form-container">
    <form id="applicationForm" action="process_application.php"
      method="POST"
      enctype="multipart/form-data">
    <!-- Step 1: Personal Information -->
    <div class="form-step" id="step1">
        <h2>Personal Information</h2>
        <div class="form-group">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="full_name" required>
            <div id="fullNameError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="ID">ID:</label>
            <input type="text" id="ID" name="student_id" required>
            <div id="IDError" class="error-message"></div>
        </div>
        <div class="button-group">
            <button type="button" data-action="next">Next</button>
        </div>
    </div>

    <!-- Step 2: Program Selection -->
    <div class="form-step" id="step2">
        <h2>Program of Study</h2>
        <div class="form-group">
            <label for="faculty">Select Faculty:</label>
            <select id="faculty" name="faculty" required>
                <option value="">Select Faculty</option>
                <option value="engineering">Engineering</option>
                <option value="business">Business</option>
                <option value="science">Science</option>
            </select>
            <div id="facultyError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="course">Select Course:</label>
            <select id="course" name="course" disabled required>
                <option value="">First select a faculty</option>
            </select>
            <div id="courseError" class="error-message"></div>
        </div>
        <div class="button-group">
            <button type="button" data-action="prev">Previous</button>
            <button type="button" data-action="next">Next</button>
        </div>
    </div>

    <!-- Step 3: Academic Grades -->
    <div class="form-step" id="step3">
        <h2>Academic Grades</h2>
        <div class="form-group">
            <label for="sciences">Sciences:</label>
            <select id="sciences" name="science_type" required>
                <option value="">Select Option</option>
                <option value="double">Science Double Award</option>
                <option value="pure">Pure Sciences</option>
            </select>
            <div id="sciencesError" class="error-message"></div>
        </div>
        
        <!-- Double Award Grades -->
        <div id="double-award-grades" style="display: none;">
            <div class="form-group">
                <label for="scienceDoubleGrade">Science Double Award Grade:</label>
                <select id="scienceDoubleGrade" name="science_double_grade" class="grade">
                    <option value="">Select Grade</option>
                    <option value="AA">AA</option>
                    <option value="BB">BB</option>
                    <option value="CC">CC</option>
                    <option value="DD">DD</option>
                    <option value="EE">EE</option>
                    <option value="FF">FF</option>
                    <option value="UU">UU</option>
                </select>
                <div id="scienceDoubleGradeError" class="error-message"></div>
            </div>
        </div>
        
        <!-- Pure Science Grades -->
        <div id="pure-science-grades" style="display: none;">
            <div class="form-group">
                <label for="biologyGrade">Biology Grade:</label>
                <select id="biologyGrade" name="biology_grade" class="grade">
                    <option value="">Select Grade</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                    <option value="U">U</option>
                </select>
                <div id="biologyGradeError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="physicsGrade">Physics Grade:</label>
                <select id="physicsGrade" name="physics_grade" class="grade">
                    <option value="">Select Grade</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                    <option value="U">U</option>
                </select>
                <div id="physicsGradeError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="chemistryGrade">Chemistry Grade:</label>
                <select id="chemistryGrade" name="chemistry_grade" class="grade">
                    <option value="">Select Grade</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                    <option value="U">U</option>
                </select>
                <div id="chemistryGradeError" class="error-message"></div>
            </div>
        </div>
        
        <!-- Core Subjects -->
        <div class="form-group">
            <label for="mathsGrade">Maths Grade:</label>
            <select id="mathsGrade" name="maths_grade" class="grade" required>
                <option value="">Select Grade</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="U">U</option>
            </select>
            <div id="mathsGradeError" class="error-message"></div>
        </div>
        
        <div class="form-group">
            <label for="englishGrade">English Grade:</label>
            <select id="englishGrade" name="english_grade" class="grade" required>
                <option value="">Select Grade</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="U">U</option>
            </select>
            <div id="englishGradeError" class="error-message"></div>
        </div>
        
        <div class="form-group">
            <label for="SetswanaGrade">Setswana Grade:</label>
            <select id="SetswanaGrade" name="setswana_grade" class="grade" required>
                <option value="">Select Grade</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="U">U</option>
            </select>
            <div id="SetswanaError" class="error-message"></div>
        </div>
        
        <!-- Additional Subjects -->
        <div class="form-group">
            <label for="CommerceGrade">Commerce Grade:</label>
            <select id="CommerceGrade" name="commerce_grade" class="grade" required>
                <option value="">Select Grade</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="U">U</option>
            </select>
            <div id="CommerceError" class="error-message"></div>
        </div>
        
        <div class="form-group">
            <label for="SocialStudiesGrade">Social Studies Grade:</label>
            <select id="SocialStudiesGrade" name="social_studies_grade" class="grade" required>
                <option value="">Select Grade</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="U">U</option>
            </select>
            <div id="SocialStudiesError" class="error-message"></div>
        </div>
        
        <!-- More subjects with name attributes... -->
        <div class="form-group">
            <label for="AgricultureGrade">Agriculture Grade:</label>
            <select id="AgricultureGrade" name="agriculture_grade" class="grade" required>
            <option value="">Select Grade</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="U">U</option>
            </select>
            <div id="AgricultureError" class="error-message"></div>
        </div>
        
        <div class="form-group">
            <label for="AccountingGrade">Accounting Grade:</label>
            <select id="AccountingGrade" name="accounting_grade" class="grade" required>
            <option value="">Select Grade</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="U">U</option>
            </select>
            <div id="AccountingError" class="error-message"></div>
        </div>
        
        <div class="form-group">
            <label for="ReligiousEducationGrade">Religious Education Grade:</label>
            <select id="ReligiousEducationGrade" name="religious_education_grade" class="grade" required>
            <option value="">Select Grade</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="U">U</option>
            </select>
            <div id="ReligiousEducationError" class="error-message"></div>
        </div>
        
        <div class="form-group">
            <label for="AdditionalMathsGrade">Additional Maths Grade:</label>
            <select id="AdditionalMathsGrade" name="additional_maths_grade" class="grade" required>
            <option value="">Select Grade</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="U">U</option>
            </select>
            <div id="AdditionalMathsError" class="error-message"></div>
        </div>
        
        <div class="form-group">
            <label for="GeologyGrade">Geology Grade:</label>
            <select id="GeologyGrade" name="geology_grade" class="grade" required>
            <option value="">Select Grade</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="U">U</option>
            </select>
            <div id="GeologyError" class="error-message"></div>
        </div>
        
        <div class="form-group">
            <label for="DevelopmentStudiesGrade">Development Studies Grade:</label>
            <select id="DevelopmentStudiesGrade" name="development_studies_grade" class="grade" required>
            <option value="">Select Grade</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="U">U</option>
            </select>
            <div id="DevelopmentStudiesError" class="error-message"></div>
        </div>
        
        <div class="form-group">
            <label for="ComputerStudiesGrade">Computer Studies Grade:</label>
            <select id="ComputerStudiesGrade" name="computer_studies_grade" class="grade" required>
            <option value="">Select Grade</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="U">U</option>
            </select>
            <div id="ComputerStudiesError" class="error-message"></div>
        </div>
        
        <div class="button-group">
            <button type="button" data-action="prev">Previous</button>
            <button type="button" data-action="next">Next</button>
        </div>
    </div>

    <!-- Step 4: Document Upload -->
    <div class="form-step" id="step4">
        <h2>Document Upload</h2>
        <div class="form-group">
            <label for="documents">Upload supporting documents (PDF, DOC, JPG, PNG):</label>
            <input type="file" id="documents" name="documents[]" multiple accept=".pdf,.doc,.docx,.jpg,.png" required>
            <div id="documentsError" class="error-message"></div>
        </div>
        <div class="button-group">
            <button type="button" data-action="prev">Previous</button>
            <button type="submit">Submit Application</button>
        </div>
    </div>
</form>
    </div>

    
</body>
</html>
