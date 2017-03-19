using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Web;

namespace Swagg.Api.Models
{
    public class SwaggDbContext : DbContext
    {
        public SwaggDbContext() : base("Swagg")
        {
        }

        public static SwaggDbContext Create()
        {
            return new SwaggDbContext();
        }

        public DbSet<Promotion> Promotions { get; set; }

        public DbSet<FileUpload> FileUploads { get; set; }
    }
}