document.addEventListener('DOMContentLoaded', () => {
    const specs = {}; // objeto donde se guardarán las specs
    const specsList = document.getElementById('specs-list');
    const specsJson = document.getElementById('specs-json');
    const addBtn = document.getElementById('add-spec');
    const keyInput = document.getElementById('spec-key');
    const valueInput = document.getElementById('spec-value');

    // Inicializa specs si hay un value en el hidden input
    if (specsJson.value) {
        try {
            const initialSpecs = JSON.parse(specsJson.value);
            Object.assign(specs, initialSpecs);
        } catch (e) {
            console.error('Error parsing initial specs:', e);
        }
    }

    function updateHiddenInput() {
        if (Object.keys(specs).length === 0) {
            specsJson.value = '';
        } else {
            specsJson.value = JSON.stringify(specs);
        }
    }

    function addSpec(key, value) {
        if (!key || !value) return;

        specs[key] = value;
        renderSpecs();
        updateHiddenInput();

        keyInput.value = '';
        valueInput.value = '';
    }

    function removeSpec(key) {
        delete specs[key];
        renderSpecs();
        updateHiddenInput();
    }

    function renderSpecs() {
        specsList.innerHTML = '';

        Object.entries(specs).forEach(([key, value]) => {
            const item = document.createElement('div');
            item.className = 'd-flex align-items-center mb-2 gap-2';

            const label = document.createElement('span');
            label.className = 'fw-bold';
            label.textContent = `${key}:`;

            const val = document.createElement('span');
            val.textContent = value;

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn btn-sm btn-danger';
            btn.textContent = '✕';
            btn.addEventListener('click', () => removeSpec(key));

            item.append(label, val, btn);
            specsList.appendChild(item);
        });
    }

    // Renderiza las specs iniciales
    renderSpecs();
    updateHiddenInput();

    // Evento para agregar nueva spec
    addBtn.addEventListener('click', () => addSpec(keyInput.value.trim(), valueInput.value.trim()));
});
