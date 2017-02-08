# excelimport-joomla

This repository helps to import bulk data from excel sheets into Joomla Database. There are different sections for different years for which the upload is taking place therefore different methods are called based on the input selected. One can avoid these methods and just use the upload and validation code.

It validates the following:
* Checks if the file uploaded is of excel type or not (xlsx)
* Checks if uploaded sheet is same as the one selected from the form dropdown of section and year.
* Checks if the particular sheet has already been uploaded. If uploaded then, it gives the duplicate error.

