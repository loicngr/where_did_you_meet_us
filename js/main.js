const elementsMeetUs = {
    label: null,
    select: null,
    textarea: null
};

function mainMeetUs() {
    elementsMeetUs.label = document.getElementById('label_where_meet_us');
    if (!elementsMeetUs.label) { return; }

    elementsMeetUs.select = elementsMeetUs.label.firstChild.children[1].firstChild;
    elementsMeetUs.select.addEventListener('change', onSelectChange);

    elementsMeetUs.textarea = elementsMeetUs.label.children[1].firstChild.firstChild;
    elementsMeetUs.textarea.style.display = 'none';
}

/**
 * On Option Selected
 * @param {Event} evt
 */
function onSelectChange(evt) {
    switch (evt.target.value) {
        case 'already_client':
            elementsMeetUs.textarea.style.display = 'none';
            elementsMeetUs.textarea.value = 'Déjà client.';
            break;
        case 'camper_van_driver':
            elementsMeetUs.textarea.style.display = 'none';
            elementsMeetUs.textarea.value = 'Camping-Caristes.';
            break;
        case 'fairs':
            elementsMeetUs.textarea.style.display = 'none';
            elementsMeetUs.textarea.value = 'Les Salons.';
            break;
        case 'social_network':
            elementsMeetUs.textarea.style.display = 'none';
            elementsMeetUs.textarea.value = 'Réseaux Sociaux.';
            break;
        case 'other':
            elementsMeetUs.textarea.value = '';
            elementsMeetUs.textarea.style.display = 'block';
            break;
        default:
            elementsMeetUs.textarea.value = '';
            elementsMeetUs.textarea.style.display = 'none';
            break;
    }
}

window.onload = mainMeetUs;