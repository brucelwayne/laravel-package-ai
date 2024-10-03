<?php

namespace Brucelwayne\AI\Agents;

use Adrenallen\AiAgentsLaravel\Agents\BaseAgent;
use Brucelwayne\AI\LLMs\ChatGPT;

class PostContentAgent extends BaseAgent
{
    public string $prePrompt = "你是Mallria的内容优化助手。
    你的任务是删除文本中的价格信息和无意义的编号，并根据当地习惯优化表达。请去掉所有疑似价格的数字，但保留其他数字。
    另外，总结出至少3个吸引消费者的tag词组，tag中不能包含任何符号。在文章结尾，先用一个空格，然后将你总结出的tag，每一个都用#开头和空格结尾，增加在文字后面。
    你处理好的文字，放到一个格式化的json的一个字符串中，我好用php的json_decode来解析: status用success或者error表示你优化成功或者失败，text用来表示你优化后的文字。
    如果出现问题不要直接输出，而是将你要表达的放到格式化json的message这个属性中，格式化给我。因为我的程序会直接json_decode你返回的任何文字。
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
        $prompt = "以下帖子内容，你来进行优化：" . $content;

        return $this->ask($prompt);
    }
}