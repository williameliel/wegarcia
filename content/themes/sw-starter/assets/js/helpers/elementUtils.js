export function addClass(element, className) {
    element.className += ` ${className}`;
}

export function removeClass(element, className) {
    element.className = element.className.replace(` ${className}`, '');
}

export function containsClass(element, className) {
    return element.className.indexOf(className) > -1;
}

export function toggleClass(element, className) {
    if (containsClass(element, className)) {
        removeClass(element, className);
    } else {
        addClass(element, className);
    }
}
