import React, { Component } from 'react';

// Dumb component
export default class Post extends Component {
    createMarkup(html) {
        return {
            __html: html
        };
    }

    render() {
        const { post } = this.props;

        return (
            <div className="blog-post">
                <a href={post.link} onClick={this.props.handler()}>
                <h2 className="blog-post-title">{post.title.rendered}</h2>
                </a>
                <p className="blog-post-meta">{post.date} <a href="#">Mark</a></p>

                <div dangerouslySetInnerHTML={this.createMarkup(post.content.rendered)} />

            </div>
        );
    }
}