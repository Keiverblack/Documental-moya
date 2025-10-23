function soloLetras(event) {
  var charCode = event.charCode; // Obtiene el código de la tecla presionada

  // 65-90 son letras mayúsculas, 97-122 son letras minúsculas
  // 32 es el espacio
  if (!((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || charCode === 32)) {
    return false; // Si no es una letra o espacio, evita que se escriba
  }
  return true; // Si es una letra o espacio, permite que se escriba
}
function soloNumeros(event) {
  var charCode = event.charCode; // Obtiene el código de la tecla presionada

  // 48-57 son los códigos ASCII de los números 0-9
  if (charCode < 48 || charCode > 57) {
    return false; // Si no es un número, evita que se escriba
  }
  return true; // Si es un número, permite que se escriba
}
// nueva: obliga min/max en el mismo input al escribir/pegar
function enforceMinMax(el, min, max) {
  if (!el) return;
  // si vacio no tocar
  if (el.value === '') return;
  // convertir a entero seguro
  var v = parseInt(el.value, 10);
  if (isNaN(v)) { el.value = ''; return; }
  if (v > max) el.value = max;
  if (v < min) el.value = min;
}