// import './assets/pspdfkit.js';

// let pspdfkitInstance; // Declare a variable to store the PSPDFKit instance

// // We need to inform PSPDFKit where to look for its library assets, i.e., the location of the `pspdfkit-lib` directory.
// const baseUrl = `${window.location.protocol}//${window.location.host}/package/assets/`;

// PSPDFKit.load({
//   baseUrl,
//   container: '#pspdfkit',
//   document: 'Document.pdf',
// })
//   .then((instance) => {
//     console.log('PSPDFKit loaded', instance);
//     pspdfkitInstance = instance; // Store the instance in a variable accessible outside the callback
//   })
//   .catch((error) => {
//     console.error(error.message);
//   });

// async function exportAndUploadPDF() {
//   try {
//     if (pspdfkitInstance) {
//       const arrayBuffer = await pspdfkitInstance.exportPDF();
//       const blob = new Blob([arrayBuffer], { type: 'application/pdf' });
//       const formData = new FormData();
//       formData.append("file", blob);

//       await fetch("pdf-save.php", {
//         method: "POST",
//         body: formData,
//       });

//       console.log("PDF exported and uploaded successfully!");
//     } else {
//       console.error("PSPDFKit instance not available.");
//     }
//   } catch (error) {
//     console.error("An error occurred:", error);
//   }
// }

// // Attach a click event listener to the button
// document.getElementById("exportButton").addEventListener("click", exportAndUploadPDF);


import './pspdfkit.js';

let pspdfkitInstance;

const baseUrl = `${window.location.protocol}//${window.location.host}/erp-dev/pspdf_assets/`;
var doc_url = $('#latest_updated_doc').val();

// alert(doc_url);
PSPDFKit.load({
  baseUrl,
  container: '#pspdfkit',
  document: doc_url,
})
  .then((instance) => {
    console.log('PSPDFKit loaded', instance);
    pspdfkitInstance = instance;
  })
  .catch((error) => {
    console.error(error.message);
  });

async function exportAndUploadPDF() {
  try {
    if (pspdfkitInstance) {

      var c_url = $('#ds_sign_form').val();

      const arrayBuffer = await pspdfkitInstance.exportPDF();
      const formData = new FormData();
      formData.append("pdfData", new Blob([arrayBuffer], { type: 'application/pdf' }), 'exported-document.pdf');
      formData.append('ds_id', $('#ds_id').val());
	
    //   await fetch(c_url, {
    //     method: "POST",
    //     body: formData,
    //   });

    //   console.log("PDF exported and uploaded to the server successfully!");
    // } else {
    //   console.error("PSPDFKit instance not available.");
    // }
    await fetch(c_url, {
			method: 'POST',
			body: formData,
			type : 'json'
		})
		.then(response => {
			if (!response.ok) {
				throw new Error('Network response was not ok');
			}
			return response.json();
		})
		.then(data => {
			//console.log('Server response:', data); // Log the response for debugging
			alert(data.message); // Display entire response data
			location.reload();
			window.close();
		})
		.catch(error => {
			console.error('Error uploading file:', error);
		});
	
        }
  } catch (error) {
    console.error("An error occurred:", error);
  }
}

// document.getElementById("exportButton").addEventListener("click", exportAndUploadPDF);
