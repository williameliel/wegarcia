export const breakpointsBase = {
    xs: 480,
    sm: 768,
    md: 992,
    lg: 1200
};

export const breakpointsMax = {
    xs: (breakpointsBase.xs - 1) + 'px',
    sm: (breakpointsBase.sm - 1) + 'px',
    md: (breakpointsBase.md - 1) + 'px',
    lg: (breakpointsBase.lg - 1) + 'px'
};

export const breakpointsMin = {
    xs: breakpointsBase.xs + 'px',
    sm: breakpointsBase.sm + 'px',
    md: breakpointsBase.md + 'px',
    lg: breakpointsBase.lg + 'px'
};

export default breakpointsMin;
