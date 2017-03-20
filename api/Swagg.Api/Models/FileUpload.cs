using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Swagg.Api.Models
{
    public class FileUpload
    {
        public int FileUploadId { get; set; }

        public string FileName { get; set; }

        public string FileData { get; set; }

        public int PromotionId { get; set; }

        public virtual Promotion Promotion { get; set; }
    }

    public enum FileType
    {
        Image,
        Video
    }
}