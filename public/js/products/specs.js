document.addEventListener('DOMContentLoaded', () => {
    // Use an array of {key, value} for predictable order and nicer rendering
    let specs = [];
    const specsList = document.getElementById('specs-list');
    const specsJson = document.getElementById('specs-json');
    const addBtn = document.getElementById('add-spec');
    const keyInput = document.getElementById('spec-key');
    const valueInput = document.getElementById('spec-value');

    if (!specsList || !specsJson || !addBtn || !keyInput || !valueInput) return;

    // Try to load existing JSON from the hidden input (handles object or array)
    try {
        const raw = specsJson.value && specsJson.value.trim();
        if (raw) {
            const parsed = JSON.parse(raw);
            if (Array.isArray(parsed)) {
                specs = parsed.map(s => ({ key: String(s.key ?? s[0] ?? ''), value: String(s.value ?? s[1] ?? '') }));
            } else if (parsed && typeof parsed === 'object') {
                specs = Object.entries(parsed).map(([k, v]) => ({ key: k, value: String(v) }));
            }
        }
    } catch (e) {
        // invalid JSON: ignore and start empty
        specs = [];
    }

    function updateHiddenInput() {
        specsJson.value = JSON.stringify(specs);
    }

    function addSpec(key, value) {
        if (!key || !value) return;
        // prevent duplicate keys (optional), update existing if found
        const idx = specs.findIndex(s => s.key === key);
        if (idx !== -1) {
            specs[idx].value = value;
        } else {
            specs.push({ key, value });
        }
        renderSpecs();
        updateHiddenInput();
        keyInput.value = '';
        valueInput.value = '';
        keyInput.focus();
    }

    function removeSpec(index) {
        if (index < 0 || index >= specs.length) return;
        specs.splice(index, 1);
        renderSpecs();
        updateHiddenInput();
    }

    function renderSpecs() {
        specsList.innerHTML = '';

        specs.forEach((spec, i) => {
            const item = document.createElement('div');
            item.className = 'd-flex align-items-center bg-secondary bg-opacity-25 rounded-3 px-3 py-1 me-1 mb-1 shadow-sm';
            item.style.minWidth = '180px';

            const info = document.createElement('div');
            info.className = 'me-3';
            const keyEl = document.createElement('div');
            keyEl.className = 'text-info fw-bold small';
            keyEl.textContent = spec.key;
            const valEl = document.createElement('div');
            valEl.className = 'text-light small';
            valEl.textContent = spec.value;
            info.appendChild(keyEl);
            info.appendChild(valEl);

            const btnWrap = document.createElement('div');
            btnWrap.className = 'ms-auto';
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn btn-sm btn-outline-light';
            btn.setAttribute('aria-label', 'remove');
            btn.innerHTML = '<i class="bi bi-x-lg"></i>';
            btn.addEventListener('click', () => removeSpec(i));
            btnWrap.appendChild(btn);

            item.appendChild(info);
            item.appendChild(btnWrap);
            specsList.appendChild(item);
        });

        // update hidden input
        updateHiddenInput();
    }

    // Events
    addBtn.addEventListener('click', () => addSpec(keyInput.value.trim(), valueInput.value.trim()));
    // allow Enter in value field to add
    valueInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            addSpec(keyInput.value.trim(), valueInput.value.trim());
        }
    });

    renderSpecs();
});