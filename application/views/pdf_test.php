<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Editor</title>
    <script src="https://unpkg.com/pdf-lib@1.18.0/dist/pdf-lib.js"></script>
</head>
<body>

<!-- Edit PDF Button -->
<button onclick="editPDF()">Edit PDF</button>

<script>
    async function editPDF() {
        const url = 'https://localhost/erp-dev/userfiles/contract_docs/example_052.pdf';
        
        // Fetch the PDF file
        const existingPdfBytes = await fetch(url).then(res => res.arrayBuffer());

        // Load the existing PDF
        const pdfDoc = await window.PDFLib.PDFDocument.load(existingPdfBytes);

        // Add your editing logic here
        // For example, adding text to the first page
        const firstPage = pdfDoc.getPages()[0];
        const { width, height } = firstPage.getSize();
        firstPage.drawText('Hello, PDF!', { x: 50, y: height - 200, fontColor: rgb(0, 0, 0) });

        // Save the modified PDF
        const modifiedPdfBytes = await pdfDoc.save();

        // Display or send the modified PDF as needed
        console.log('Modified PDF:', modifiedPdfBytes);
    }
</script>

</body>
</html>
