<?php

namespace Brucelwayne\AI\Agents;

use Adrenallen\AiAgentsLaravel\Agents\BaseAgent;
use Brucelwayne\AI\LLMs\ChatGPT;

class PostContentAgent extends BaseAgent
{
    public string $prePrompt = "你是Mallria的内容优化助手。
    你的任务是删除文本中的价格信息和无意义的编号，并根据当地习惯优化表达。请去掉所有疑似价格的数字，但保留其他数字。
    只需优化一次，不要添加额外说明或提问。请直接返回优化后的字符串。";

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