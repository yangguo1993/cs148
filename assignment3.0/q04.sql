SELECT DISTINCT fldCRN, fldFirstName, fldLastName FROM tblEnrolls JOIN tblSections ON fnkSectionID = fldCRN JOIN tblCourses ON pmkCourseId = tblEnrolls.fnkCourseId JOIN tblStudents ON pmkStudentId = fnkStudentId WHERE tblEnrolls.fnkCourseId LIKE '392'
ORDER BY tblSections.fldCRN, fldFirstName, fldLastName ASC
