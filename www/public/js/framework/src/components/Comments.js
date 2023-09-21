export default function Comments(comments) {

     comments = JSON.parse(comments);
    console.log("Comments", comments);
    //recover from json

    return {
        type: "div",
        children: [
            {
                type: "h1",
                children: ["Comments"],
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