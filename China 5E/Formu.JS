const formulario = document.getElementById('formulario');
const lista = document.getElementById('lista');

formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	const nombre = document.getElementById('nombre').value;
	const apellido = document.getElementById('apellido').value;
	const telefono = document.getElementById('telefono').value;
    const correo = document.getElementById('correo').value;
    const alias = document.getElementById('alias').value;
	const listaItem = document.createElement('div');
	listaItem.classList.add('lista-item');
	listaItem.innerHTML = `
		${nombre} ${apellido}: ${telefono} ${correo} ${alias}
	`;
	lista.appendChild(listaItem);
	formulario.reset();
});