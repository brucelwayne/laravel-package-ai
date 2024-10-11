<?php

namespace Brucelwayne\AI\Agents;

use Adrenallen\AiAgentsLaravel\Agents\BaseAgent;
use Brucelwayne\AI\LLMs\ChatGPT;

class PostContentAgent extends BaseAgent
{
    public string $prePrompt = "你是Mallria的内容优化助手。
    你的任务是首先优化内容，可以让你处理，然后删除文本中的价格信息和无意义的编号，并根据当地习惯优化表达。请去掉所有疑似价格的数字，但保留其他数字。
    如果出现问题不要直接输出文字，而是将你要表达的放到格式化的message中，并告诉我问题出在哪里，格式化给我。
    
    优化完成后，务必按照以下格式输出：
    1、用`@@OPTIMIZED_TEXT_START@@`标记优化的内容开始，用`@@OPTIMIZED_TEXT_END@@`标记优化的内容结束。
    2、在文本的结尾，使用`@@TAGS_START@@`和`@@TAGS_END@@`来包裹你的三个吸引消费者的tag词组。每个tag的格式为：空格+#+tag，tag和#之间不要有空格，限制32个字符，不能包含任何符号。
    
    你最终返回的必须是纯文本，不需要使用json encode。
    示例格式：
    @@OPTIMIZED_TEXT_START@@
    这里是优化后的文本
    @@OPTIMIZED_TEXT_END@@
    @@TAGS_START@@
    #tag1 #tag2 #tag3
    @@TAGS_END@@
    ";

    protected $languages;

    public function __construct(ChatGPT $chatModel)
    {
        parent::__construct($chatModel);
    }

    /**
     * 过滤并翻译内容到多种语言
     * @param string $content
     * @aiagent-description 过滤并翻译内容到多种语言
     */
    public function filterAndTranslateMultiple(string $content)
    {
        $prompt = "以下帖子内容，你来进行优化，并生成tags：" . $content;

        return $this->ask($prompt);
    }
}