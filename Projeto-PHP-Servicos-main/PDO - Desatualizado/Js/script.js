function addServico(id,nome,valor){
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalOS')).hide();
    const tcorpo = document.getElementById('itemOS');
    const linha = document.createElement('tr');
    var inputId = '<td><input name="id[]" value="'+id+'" readonly size="5" class="form-control-plaintext"></td>'
    var inputNome = '<td>'+nome+'</td>'
    var inputValor = '<td>'+valor+'</td>'
    var inputQtd = '<td>'+valor+'</td>'
    var inputTotal = '<td>'+valor+'</td>'
    linha.innerHTML=inputId+inputNome+inputValor+inputQtd+inputTotal;
    tcorpo.appendChild(linha);
}