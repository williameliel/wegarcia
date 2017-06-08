import fetch from 'isomorphic-fetch';
import { WP_URL } from '../wp-url';

export const RECEIVE_PAGE = 'RECEIVE_PAGE';
export const RECEIVE_POSTS = 'RECEIVE_POSTS';

const POSTS_PER_PAGE = 10;

function receivePage(pageName, pageData) {
    return {
        type: RECEIVE_PAGE,
        payload: {
            pageName: pageName,
            page: pageData
        }
    };
}

export function fetchPageIfNeeded(pageName) {
 
    return function(dispatch, getState) {
        if (shouldFetchPage(getState(), pageName)) {
            return fetch(WP_URL + '/pages?filter[name]=' + pageName)
                .then(response => response.json())
                .then(pages => dispatch(receivePage(pageName, pages[0])));
        }
    }
}

function shouldFetchPage(state, pageName) {
    const pages = state.pages;

    return !pages.hasOwnProperty(pageName);
}

export function fetchPosts(pageNum = 1) {
    return function (dispatch) {
        return fetch(WP_URL + '/posts?filter[paged]=' + pageNum + '&filter[posts_per_page]=' + POSTS_PER_PAGE)
            .then(response => Promise.all(
                [response.headers.get('X-WP-TotalPages'), response.json()]
            ))
            .then(postsData => dispatch(
                receivePosts(pageNum, postsData[0], postsData[1])
            ));
    }
}

function receivePosts(pageNum, totalPages, posts) {
    return {
        type: RECEIVE_POSTS,
        payload: {
            pageNum: pageNum,
            totalPages: totalPages,
            posts: posts
        }
    };
}

