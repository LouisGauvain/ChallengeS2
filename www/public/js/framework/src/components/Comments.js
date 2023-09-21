export default function Comments(comments) {

    if (typeof comments === "string")
        comments = JSON.parse(comments);
    else {
        comments = comments.children[0]
    }

    if (comments.length === 0) {
        return {
            type: "div",
            children: [
                {
                    type: "div",
                    attributes: {
                        style: {
                            height: "5px",
                            width: "80%",
                            backgroundColor: "black",
                            margin: "40px auto",
                            borderRadius: "5px",
                        },
                    },
                },
                {
                    type: "h2",
                    children: ["Commentaires"],
                    attributes: {
                        style: {
                            textAlign: "center"
                        }
                    }
                },
                {
                    type: "p",
                    children: ["Aucun commentaire pour le moment"],
                    attributes: {
                        style: {
                            textAlign: "center"
                        }
                    }
                }
            ]
        }
    }
    return {
        type: "div",
        children: [
            {
                type: "h2",
                children: ["Commentaires"],
            },
            {
                type: "table",
                children: [
                    {
                        type: "thead",
                        children: [
                            {
                                type: "tr",
                                children: [
                                    {
                                        type: "th",
                                        children: ["Name"],
                                    },
                                    {
                                        type: "th",
                                        children: ["Comment"],
                                    },
                                ]
                            }
                        ]
                    },
                    {
                        type: "tbody",
                        children: comments.map((comment) => {
                            return {
                                type: "tr",
                                children: [
                                    {
                                        type: "td",
                                        children: [comment.user_name],
                                    },
                                    {
                                        type: "td",
                                        children: [comment.content],
                                    },
                                ]
                            }
                        })
                    }
                ]
            }
        ]
    }
}