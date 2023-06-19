const btnGenerate = document.querySelector("#generatePdf");

btnGenerate.addEventListener("click", () => {
    const content = document.querySelector("#contentPdf");

    const options = {
        margin: [10, 10, 10, 10],
        filename: "conta.pdf",
        html2canvas: {scale: 1},
        jsPDF: {unit: "mm", format: "a4", orientation: "portrait"}
    }

    html2pdf().set(options).from(content).save();
});