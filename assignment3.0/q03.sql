SELECT DISTINCT fldCourseName, fldStart, fldStop, fldDays, fldFirstName, fldLastName FROM tblCourses JOIN tblSections ON pmkCourseId = fnkCourseId JOIN tblTeachers ON pmkNetId = fnkTeacherNetId WHERE tblTeachers.fldFirstName LIKE 'Jackie%' ORDER BY `tblSections`.`fldStart` ASC