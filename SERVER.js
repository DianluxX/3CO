const express = require('express');
const xlsx = require('xlsx');
const app = express();

app.use(express.json());

app.post('/save-data', (req, res) => {
  console.log(req.body);
  let workbook;
  let worksheet;
  
  try {
    // Intenta leer el archivo existente
    workbook = xlsx.readFile('datos_formulario.xlsx');
    worksheet = workbook.Sheets[workbook.SheetNames[0]];
  } catch (err) {
    // Si el archivo no existe, crea uno nuevo
    workbook = xlsx.utils.book_new();
    worksheet = xlsx.utils.aoa_to_sheet([['Nombres', 'DNI', 'Oficina', 'Teléfono']]);
  }

  // Agrega los nuevos datos al final de la hoja
  let new_data = [req.body.name, req.body.dni, req.body.office, req.body.phone];
  xlsx.utils.sheet_add_aoa(worksheet, [new_data], {origin: -1});

  // Guarda el archivo
  xlsx.utils.book_append_sheet(workbook, worksheet, 'Datos del Formulario');
  xlsx.writeFile(workbook, 'datos_formulario.xlsx');

  res.json({status: 'success'});
});

app.listen(3000, () => console.log('Server running'));


